<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = [
        'user_id',
        'transaction_id',
        'package_id',
        'razorpay_id',
        'order_id'
    ];

}
