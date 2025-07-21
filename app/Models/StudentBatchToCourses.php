<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBatchToCourses extends Model
{
    use HasFactory;
    protected $fillable = [
        "packageId",
        "batchId",
    ];
}
