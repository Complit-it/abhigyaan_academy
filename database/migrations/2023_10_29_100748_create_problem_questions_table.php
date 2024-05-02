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
        Schema::create('problem_questions', function (Blueprint $table) {
            $table->id();
            $table->string('brandId');
            $table->string('categoryId');
            $table->string('modelId');
            $table->string('priority')->nullable();
            $table->string('question');
            $table->string('question_type')->default('text');
            $table->string('problem_category_id');
            $table->string('total_options');
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
        Schema::dropIfExists('problem_questions');
    }
};
