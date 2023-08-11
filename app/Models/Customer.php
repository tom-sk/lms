<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class Customer extends Model
{
    use HasFactory, Notifiable, Billable;

    protected $fillable = [
        'email',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'stripe_id',
        'email_verified_at',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
        'last_login'
    ];

    public function orders(): MorphOne
    {
        return $this->morphOne(Order::class, 'customer');
    }
}
