<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesHasSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_has_subjects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('classes_id')->unsigned();
            $table->bigInteger('subjects_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('classes_has_subjects', function (Blueprint $table){

            $table->foreign('classes_id')->references('id')->on('classes')->onDelete('cascade');
        });

        Schema::table('classes_has_subjects', function (Blueprint $table){

            $table->foreign('subjects_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes_has_subjects');
    }
}
