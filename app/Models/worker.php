<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class worker extends Model
{
    use HasFactory, HasUuids, HasApiTokens;

    protected $fillable = [
        'name',
        'phone_no',
        'aadhaar_no',
        'email',
        'account_no',
        'accholder_name',
        'bank_name',
        'branch_name',
        'ifsc_code',
        'pan_no',
        'name_pan',
        'job',
        'job_disc',
        'gst_no',
        'gst_name',
        'lat',
        'long',
        'brand',
        'model',
        'area',
        'otp',
        'fcm_token',
        'notification',
        'fcm_token',
        'is_active',
        'servics',

    ];

    protected $hidden = [
        'remember_token',
    ];
    protected $table = 'workers';

    // /**
    //  * Get the name of the unique identifier for the user.
    //  *
    //  * @return string
    //  */

    //  public function getAuthIdentifierName()
    //  {
    //      return 'uuid';
    //  }

    //  /**
    //  * Get the unique identifier for the user.
    //  *
    //  * @return mixed
    //  */

    // public function getAuthIdentifier()
    // {
    //     return $this->{$this->getKeyName()};
    // }

    // public function getAuthPassword()
    // {
    //     return $this->password;
    // }

    // public function getRememberToken()
    // {
    //     return $this->remember_token;
    // }

    // public function setRememberToken($value)
    // {
    //     $this->remember_token = $value;
    // }

    // public function getRememberTokenName()
    // {
    //     return 'remember_token';
    // }
}
