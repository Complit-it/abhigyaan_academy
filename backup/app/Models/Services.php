<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $fillable = [
        'serviceproviderId_fk',
        'name',
        'description',
        'image',
    ];

    public function service()
    {
        return $this->belongsTo(ServicesProviderType::class, 'serviceproviderId_fk');
    }
}
