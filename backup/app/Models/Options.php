<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'option',
        'is_correct',
        'service_category_id',
        'service_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
