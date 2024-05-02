<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCQs extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject_id',
        'topic_id',
        'sub_topic_id',
        'sub_sub_topic_id',
        'question_text',
        'question_image',
        'correct_answer',
        'option_1_text',
        'option_2_text',
        'option_3_text',
        'option_4_text',
        'option_1_image',
        'option_2_image',
        'option_3_image',
        'option_4_image',
        'answer_explanation_text',
        'answer_explanation_image'
    ];
}
