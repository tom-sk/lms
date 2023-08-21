<?php

namespace App\Models;

use DoubleThreeDigital\Runway\Traits\HasRunwayResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Resource extends Model
{
    use HasFactory;
    use HasRunwayResource;

    protected $fillable = ['title', 'type', 'content'];
    protected $hidden = ['created_at', 'updated_at'];


    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class);
    }
}
