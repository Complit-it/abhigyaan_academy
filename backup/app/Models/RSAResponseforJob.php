<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RSAResponseforJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'rsa_id',
        'response',
        
    ];
}
