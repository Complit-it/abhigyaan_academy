<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangesUpdatedByUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'change_id',
        'status'
    ];
}
