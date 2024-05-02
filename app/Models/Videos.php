<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject_id',
        'topic_id',
        'sub_topic_id',
        'sub_sub_topic_id',
        'description',
        'video_url',
        'status',
    ];
}
