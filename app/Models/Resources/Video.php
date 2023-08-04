<?php

namespace App\Models\Resources;

use App\Models\Topic;
use DoubleThreeDigital\Runway\Traits\HasRunwayResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Video extends Model
{
    use HasFactory;
    use HasRunwayResource;

    protected $fillable = ['title', 'excerpt', 'url', 'thumbnail', 'industry'];
    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class);
    }
}
