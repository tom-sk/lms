<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class Customer extends Model
{
    use HasFactory, Notifiable, Billable;

    protected $fillable = [
        'email',
    ];
}
