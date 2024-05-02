<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorWorkingBrand extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brand_id',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
