<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemQuestions extends Model
{
    use HasFactory;

    protected $fillable = [
        'brandId',
        'categoryId',
        'modelId',
        'priority',
        'question',
        'question_type',
        'total_options',
        'problem_category_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
