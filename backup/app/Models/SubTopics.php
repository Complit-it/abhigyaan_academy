<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTopics extends Model
{
    use HasFactory;
    protected $fillable = [
        "subject_id",
        "topic_id",
        "name",
        "description",
        "icon_url",
        "status",
    ];
}
