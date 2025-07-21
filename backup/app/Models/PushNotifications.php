<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotifications extends Model
{
    use HasFactory;
    protected $fillable = [
        'sendTo',
        'title',
        'body',
        'image'
    ];
}
