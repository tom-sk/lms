<?php

namespace App\Models\Resources;

use DoubleThreeDigital\Runway\Traits\HasRunwayResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    use HasRunwayResource;

    protected $fillable = ['title', 'excerpt', 'url', 'thumbnail', 'industry'];
    protected $hidden = ['created_at', 'updated_at'];
}
