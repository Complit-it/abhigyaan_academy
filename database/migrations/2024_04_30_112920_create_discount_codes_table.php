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
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('discount_amount');
            $table->string('discount_for');
            $table->string('discount_code_status');
            $table->string('used_on');
            $table->string('valid_from');
            $table->string('valid_to');
            $table->string('max_usage_limit');
            $table->string('usage_limit_per_user');
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
        Schema::dropIfExists('discount_codes');
    }
};
