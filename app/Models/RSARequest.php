<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RSARequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'latitude',
        'longitude',
        'status',
        'current_radius',
    ];
}
