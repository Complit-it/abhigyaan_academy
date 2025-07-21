<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionsProvidedbyUser extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "job_id",
        "vehicle_id",
        "question_id",
        "option_id",
        "text_answer",
        "image_answer",
    ];
}
