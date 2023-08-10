<?php

namespace App\Models;

use DoubleThreeDigital\Runway\Traits\HasRunwayResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use Statamic\Http\Resources\CP\Users\Users;

class Module extends Model
{
    use HasFactory;
    use HasRunwayResource;

    protected $fillable = [
        'title',
        'content',
        'enrolled'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class)
            ->orderBy('module_topic.sort_order', 'ASC');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(Users::class);
    }

    public function progress()
    {
        $moduleTopics = $this->topics()->get();

        $totalCompleteSlides = $moduleTopics->sum(function (Topic $topic) {
            return $topic->slidesComplete();
        });

        $moduleSlides = $moduleTopics->sum(function (Topic $topic) {
            return $topic->totalSlides();
        });

        $moduleCompletePercent = ($totalCompleteSlides / $moduleSlides) * 100;


        return round($moduleCompletePercent, 2);
    }
}
