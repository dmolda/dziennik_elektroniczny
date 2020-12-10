<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersHasSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers_has_subjects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('teachers_id')->unsigned()->nullable();
            $table->bigInteger('subjects_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('teachers_has_subjects', function (Blueprint $table) {
           $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('cascade');
        });

        Schema::table('teachers_has_subjects', function (Blueprint $table) {
            $table->foreign('subjects_id')->references('id')->on('subjects')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers_has_subjects');
    }
}
