<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Module extends Model
{
    use HasFactory;

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class)
            ->orderBy('module_topic.sort_order', 'ASC');
    }
}
