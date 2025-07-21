<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleReviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id',
        'reviewer_name',
        'reviewer_photo',
        'reviewer_rating',
        'reviewer_text',
        'authorId'
    ];
}
