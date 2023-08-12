<?php

namespace App\Models;

use DoubleThreeDigital\Runway\Traits\HasRunwayResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;
    use HasRunwayResource;

    protected $fillable = ['title', 'type', 'content'];
    protected $hidden = ['created_at', 'updated_at'];
}
