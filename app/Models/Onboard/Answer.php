<?php

namespace App\Models\Onboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['question_id', 'user_id', 'value'];

}
