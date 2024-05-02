<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandCtaegoryMapping extends Model
{
    use HasFactory;
    protected $fillable = ['brand_id', 'category_id'];

    public function brand()
    {
        return $this->belongsTo(VehicleBrand::class);
    }

    public function category()
    {
        return $this->belongsTo(VehicleCategory::class);
    }
}
