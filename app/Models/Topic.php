<?php

namespace App\Models;

use App\Models\Resources\Video;
use DoubleThreeDigital\Runway\Traits\HasRunwayResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Topic extends Model
{
    use HasFactory;
    use HasRunwayResource;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'content',
    ];

    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class);
    }

    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(Resource::class);
    }

    public function slides(): HasMany
    {
        return $this->hasMany(Slide::class)->orderBy('sort_order');
    }

    public function totalSlides()
    {
        return $this->slides()->count();
    }

    public function videos(): BelongsToMany
    {
        return $this->belongsToMany(Video::class);
    }

    public function slidesComplete()
    {
        $user = Auth::user();
        $slides = $this->slides->pluck('id')->toArray();
        $totalSlides = count($slides);

        $completedSlides = $user->completedSlides()->pluck('slide_id')->toArray();
        $diff = count(array_diff($slides, $completedSlides));

        return $totalSlides - $diff;
    }

    public function progress()
    {
        $slidesComplete = $this->slidesComplete();
        $totalSlides = $this->slides()->count();

        return round(($slidesComplete / $totalSlides) * 100);
    }
}
