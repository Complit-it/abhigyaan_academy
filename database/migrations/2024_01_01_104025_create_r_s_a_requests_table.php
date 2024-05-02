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
        Schema::create('r_s_a_requests', function (Blueprint $table) {
            $table->id();
            $table->string('job_id');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('status');
            $table->string('current_radius');
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
        Schema::dropIfExists('r_s_a_requests');
    }
};
