<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCQanswersbyuser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'batch_id',
        'attempt_id',
        'question_id',
        'selected_answer'
    ];
}
