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
        Schema::create('blogs_models', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable();
            $table->string('title', 1000)->nullable();
            $table->string('slug', 1000)->nullable();
            $table->string('published_on');
            $table->string('featured_image')->nullable();
            $table->string('tags', 1000)->nullable();
            $table->binary('actual_blog')->nullable();
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
        Schema::dropIfExists('blogs_models');
    }
};
