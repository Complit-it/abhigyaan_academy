<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'name',
        'description',
        "icon_url",
        'status',
    ];
}
