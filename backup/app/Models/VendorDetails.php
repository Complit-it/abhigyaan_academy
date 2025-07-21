<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDetails extends Model
{
    use HasFactory;

    protected $fillable = [
    'vendor_code',
    'user_id',
    'vendor_type',
    'bank_name',
    'bank_account_no',
    'bank_ifsc_code',
    'bank_branch',
    'pan_no',
    'gst_no',
    'aadhar_no',
    'aadhar_front',
    'aadhar_back',
    'pan_card',
    'gst_certificate',
    'address_proof',
    'vendor_status',
    'latitude',
    'longitude',
    'prelimiary_check',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
