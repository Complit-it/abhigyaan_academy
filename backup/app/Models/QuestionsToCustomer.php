<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsToCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'problem_category_id',
    ];
}
