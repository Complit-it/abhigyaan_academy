<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadableDocuments extends Model
{
    use HasFactory;

    protected $fillable = [
        "subject_id",
        "topic_id",
        "sub_topic_id",
        "sub_sub_topic_id",
        "title",
        "description",
        "file_url",
        "status",
    ];
}
