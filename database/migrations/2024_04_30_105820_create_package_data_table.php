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
        Schema::create('package_data', function (Blueprint $table) {
            $table->id();
            $table->string('package_id');
            $table->string('package_code');
            $table->string('subject_id');
            $table->string('topic_id');
            $table->string('sub_topic_id');
            $table->string('sub_sub_topic_id');
            $table->string('data_type');
            $table->string('data_id');
            $table->string('include_file');
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
        Schema::dropIfExists('package_data');
    }
};
