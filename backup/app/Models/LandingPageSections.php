<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPageSections extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'order',
        'sub_header',
        'is_active',
    ];
}
