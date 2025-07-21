<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        "package_code",
        "package_name",
        "package_description",
        "package_price",
        "package_duration",
        "package_duration_type",
        "package_type",
        "package_status",
        "package_image"
    ];
}
