<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCodes extends Model
{
    use HasFactory;

    protected $fillable = [
        "code",
        "discount_amount",
        'discount_for',
        'discount_code_status',
        'used_on',
        'valid_from',
        'valid_to',
        'max_usage_limit',
        'usage_limit_per_user',
        'status',
    ];
}
