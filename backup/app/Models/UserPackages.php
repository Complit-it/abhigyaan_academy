<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPackages extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'package_code',
        'applied_discount_code',
        'payment_id',
        'payment_status',
        'package_start_date',
        'package_end_date',
        'is_paused',
        'status',
    ];
}
