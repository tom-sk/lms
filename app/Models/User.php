<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Onboard\Question;
use App\Models\Onboard\UserAnswers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use function Pest\Laravel\json;

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

    public function answers(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'user_question', 'user_id', 'question_id')
            ->withPivot('value');
    }

    public function attachQuestion(Question $questionId, $value): void
    {
        $data = [$questionId['id'] => ['value' => json_encode($value)]];

        $this->answers()->syncWithoutDetaching($data);
    }
}
