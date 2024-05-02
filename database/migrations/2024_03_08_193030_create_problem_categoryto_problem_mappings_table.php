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
        Schema::create('problem_categoryto_problem_mappings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('problem_category_id');
            $table->unsignedBigInteger('service_provider_id');
            $table->unsignedBigInteger('service_id');
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
        Schema::dropIfExists('problem_categoryto_problem_mappings');
    }
};
