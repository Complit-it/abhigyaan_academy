<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogsModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'slug',
        'published_on',
        'featured_image',
        'actual_blog',
        'status'
    ];
}
