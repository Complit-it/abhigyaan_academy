<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'session_id', 'activity_date', 'time_spent'];

}
