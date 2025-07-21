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
        Schema::create('google_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('place_id');
            $table->string('reviewer_name');
            $table->string('reviewer_photo');
            $table->integer('reviewer_rating');
            $table->text('reviewer_text');
            $table->string('authorId');
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
        Schema::dropIfExists('google_reviews');
    }
};
