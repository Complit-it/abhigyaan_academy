<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBatch extends Model
{
    use HasFactory;
    protected $fillable = [
        "batchId",
        "batchName",
        "startDate",
        "endDate",     
        ];
    }