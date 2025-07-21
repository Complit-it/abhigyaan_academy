<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usermcqresult extends Model
{
    use HasFactory;

    protected $fillable = [
        'batchId',
        'userId',
        'correctAns',
        'finalScore',
        'totalans',
        'timetaken',
        'category',
        'rank',
    ];
}
