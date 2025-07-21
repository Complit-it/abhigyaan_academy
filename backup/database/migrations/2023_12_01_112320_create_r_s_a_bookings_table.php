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
        Schema::create('r_s_a_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('worker_id');
            $table->string('job_id');
            $table->integer('customer_id');
            $table->integer('vehicle_id');
            $table->string('work_status');
            $table->integer('ispaid');
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
        Schema::dropIfExists('r_s_a_bookings');
    }
};
