<?php

namespace App\Models;

use DoubleThreeDigital\Runway\Traits\HasRunwayResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Statamic\Http\Resources\CP\Users\Users;

class Module extends Model
{
    use HasFactory;
    use HasRunwayResource;

    protected $fillable = [
        'title',
        'content'
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
}
