<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('phone_no')->unique();
            $table->string('aadhaar_no')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('account_no')->nullable();
            $table->string('accholder_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('name_pan')->nullable();
            $table->string('job')->nullable();
            $table->string('job_disc')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('gst_name')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('area')->nullable();
            $table->string('otp')->nullable();
            $table->string('fcm_token')->nullable();
            $table->string('notification')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('address')->nullable();
            $table->boolean('category')->nullable();
            $table->boolean('servics')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workers');
    }
};
