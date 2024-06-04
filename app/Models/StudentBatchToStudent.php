<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBatchToStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        "studentId",
        "batchId",
    ];
}
