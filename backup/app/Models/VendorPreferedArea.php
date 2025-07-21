<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPreferedArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'area',
        'status',
    ];
}
