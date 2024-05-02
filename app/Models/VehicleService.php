<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleService extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicleModelId_fk',
        'vehicleServiceId_fk',
    ];

    public function vehiclemodel()
    {
        return $this->belongsTo(VehicleModel::class, 'vehicleModelId_fk');
    }
    public function servicesubcategory()
    {
        return $this->belongsTo(ServiceSubCategory::class, 'vehicleServiceId_fk');
    }
    

}
