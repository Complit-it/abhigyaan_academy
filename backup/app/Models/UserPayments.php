<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayments extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'package_id',
        'transaction_id',
        'payment_status',
        'payment_amount',
        'payment_date',
        'payment_mode',
    ];
}
