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
        Schema::create('options_providedby_users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('job_id');
            $table->string('vehicle_id');
            $table->string('question_id');
            $table->string('option_id')->nullable();
            $table->string('text_answer')->nullable();
            $table->string('image_answer')->nullable();
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
        Schema::dropIfExists('options_providedby_users');
    }
};
