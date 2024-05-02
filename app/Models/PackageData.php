<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageData extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'package_code',
        'subject_id',
        'topic_id',
        'sub_topic_id',
        'sub_sub_topic_id',
        'data_type',
        'data_id',
        'include_file',
        'status',
    ];
}
