<?php

namespace App\Models\Onboard;

use App\Models\Onboard\UserAnswers;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['title', 'type'];

    public function answers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_question')
            ->withPivot('value');
    }
}
