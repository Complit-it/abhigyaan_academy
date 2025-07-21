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
        Schema::create('usermcqresults', function (Blueprint $table) {
            $table->id();
            $table->string('batchId')->nullable();
            $table->string('userId')->nullable();
            $table->string('correctAns')->nullable();
            $table->string('finalScore')->nullable();
            $table->string('totalans')->nullable();
            $table->string('timetaken')->nullable();
            $table->string('category')->nullable();
            $table->string('rank')->nullable();
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
        Schema::dropIfExists('usermcqresults');
    }
};
