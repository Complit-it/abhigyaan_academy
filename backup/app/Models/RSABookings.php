<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RSABookings extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'job_id',
        'customer_id',
        'vehicle_id',
        'work_status',
        'ispaid',
    ];
}
