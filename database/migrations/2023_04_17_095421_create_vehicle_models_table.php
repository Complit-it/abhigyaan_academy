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
        Schema::create('vehicle_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicleCategoryId_fk')->constrained('vehicle_categories');
            $table->foreignId('vehicleBrandId_fk')->constrained('vehicle_brands');
            $table->string('name');
            $table->string('year');
            $table->string('description')->nullable();
            $table->string('image')->nullable()->default('default_model.png');
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
        Schema::dropIfExists('vehicle_models');
    }

    
};
