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
        Schema::create('user_packages', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('package_id');
            $table->string('package_code');
            $table->string('applied_discount_code')->nullable();
            $table->string('payment_id');
            $table->string('payment_status');
            $table->string('package_start_date');
            $table->string('package_end_date');
            $table->string('is_paused');
            $table->string('status');
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
        Schema::dropIfExists('user_packages');
    }
};
