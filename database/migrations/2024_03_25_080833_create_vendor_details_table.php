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
        Schema::create('vendor_details', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_type')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('bank_ifsc_code')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('aadhar_front')->nullable();
            $table->string('aadhar_back')->nullable();
            $table->string('pan_card')->nullable();
            $table->string('gst_certificate')->nullable();
            $table->string('address_proof')->nullable();
            $table->string('vendor_status')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('prelimiary_check',1)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vendor_code');

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
        Schema::dropIfExists('vendor_details');
    }
};
