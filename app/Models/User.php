<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Onboard\Answer;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class);
    }

    public function slides(): BelongsToMany
    {
        return $this->belongsToMany(Slide::class)->withPivot('slide_complete');
    }

    public function completedSlides(): BelongsToMany
    {
        return $this->slides()->wherePivot('slide_complete', true);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function formattedAnswers(): array
    {
        return $this->answers()->get()->map(function ($answer) {
            return [
                'id' => $answer->id,
                'question_id' => $answer->question_id,
                'value' => json_decode($answer->value),
            ];
        })->toArray();
    }
}
