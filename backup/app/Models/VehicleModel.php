<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicleCategoryId_fk',
        'vehicleBrandId_fk',
        'name',
        'year',
        'description',
        'image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function vehicleCategory()
    {
        return $this->belongsTo(VehicleCategory::class, 'vehicleCategoryId_fk');
    }

    public function vehicleBrand()
    {
        return $this->belongsTo(VehicleBrand::class, 'vehicleBrandId_fk');
    }
}
