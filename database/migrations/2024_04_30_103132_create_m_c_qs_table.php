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
        Schema::create('m_c_qs', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id');
            $table->string('title');
            $table->string('subject_id');
            $table->string('topic_id');
            $table->string('sub_topic_id');
            $table->string('sub_sub_topic_id');
            $table->string('question_text');
            $table->string('question_image');
            $table->string('correct_answer');
            $table->string('option_1_text');
            $table->string('option_2_text');
            $table->string('option_3_text');
            $table->string('option_4_text');
            $table->string('option_1_image');
            $table->string('option_2_image');
            $table->string('option_3_image');
            $table->string('option_4_image');
            $table->string('answer_explanation_text');
            $table->string('answer_explanation_image');
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
        Schema::dropIfExists('m_c_qs');
    }
};
