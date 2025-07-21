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
        Schema::create('m_c_qanswersbyusers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('batch_id');
            $table->string('attempt_id');
            $table->string('question_id');
            $table->string('selected_answer');
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
        Schema::dropIfExists('m_c_qanswersbyusers');
    }
};
