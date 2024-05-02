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
        Schema::create('package_details', function (Blueprint $table) {
            $table->id();
            $table->string('package_code');
            $table->string('package_name');
            $table->string('package_description');
            $table->string('package_price');
            $table->string('package_duration');
            $table->string('package_duration_type');
            $table->string('package_type');
            $table->string('package_status');
            $table->string('package_image');
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
        Schema::dropIfExists('package_details');
    }
};
