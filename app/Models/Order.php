<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'user_id', 'product_id', 'status'];

    public function customer(): MorphTo
    {
        return $this->morphTo();
    }
}
