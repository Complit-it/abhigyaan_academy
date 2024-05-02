<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVehicles extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_category_id',
        'vehicle_model_id',
        'vehicle_brand_id',
        'vehicle_number',
        'vehicle_image',
        'vehicle_color',
        'vehicle_fuel_type',
        'vehicle_fuel_capacity',
        'vehicle_seating_capacity',
        'vehicle_registration_date',
        'vehicle_registration_expiry_date',
        'vehicle_insurance_expiry_date',
        'vehicle_insurance_company',
        'vehicle_insurance_policy_number',
        'vehicle_insurance_amount',
        'vehicle_insurance_pdf',
        'vehicle_insurance_claim',
        'vehicle_insurance_claim_amount',
        'vehicle_insurance_claim_pdf',
        'vehicle_insurance_claim_date',
        'vehicle_insurance_claim_status',
        'vehicle_insurance_claim_remarks',
        'vehicle_rc_image',
        'passcode'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
