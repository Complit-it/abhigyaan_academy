<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemCategorytoProblemMapping extends Model
{
    use HasFactory;

    protected $fillable = [
        'problem_category_id',
        'service_provider_id',
        'service_id',
    ];
}
