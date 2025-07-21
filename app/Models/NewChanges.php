<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewChanges extends Model
{
    use HasFactory;

    protected $fillable = [
        'module',
        'change_by',
        'status',
    ];
}
