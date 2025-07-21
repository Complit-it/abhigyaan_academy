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
        Schema::create('user_vehicles', function (Blueprint $table) {
            $table->id()->uniqid();
            $table->integer('user_id');
            $table->integer('vehicle_category_id');
            $table->integer('vehicle_model_id');
            $table->integer('vehicle_brand_id');
            $table->string('vehicle_number');
            $table->string('vehicle_image')->nullable();
            $table->string('vehicle_color')->nullable();
            $table->string('vehicle_fuel_type')->nullable();
            $table->string('vehicle_fuel_capacity')->nullable();
            $table->string('vehicle_seating_capacity')->nullable();
            $table->string('vehicle_registration_date')->nullable();
            $table->string('vehicle_registration_expiry_date')->nullable();
            $table->string('vehicle_insurance_expiry_date')->nullable();
            $table->string('vehicle_insurance_company')->nullable();
            $table->string('vehicle_insurance_policy_number')->nullable();
            $table->string('vehicle_insurance_amount')->nullable();
            $table->string('vehicle_insurance_pdf')->nullable();
            $table->string('vehicle_insurance_claim')->nullable();
            $table->string('vehicle_insurance_claim_amount')->nullable();
            $table->string('vehicle_insurance_claim_pdf')->nullable();
            $table->string('vehicle_insurance_claim_date')->nullable();
            $table->string('vehicle_insurance_claim_status')->nullable();
            $table->string('vehicle_insurance_claim_remarks')->nullable();
            $table->string('vehicle_rc_image')->nullable();
            $table->string('passcode')->nullable()->default('Password@123');
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
        Schema::dropIfExists('user_vehicles');
    }
};
