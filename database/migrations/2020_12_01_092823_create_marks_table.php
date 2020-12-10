<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->string('mark_desc');
            $table->float('mark');
            $table->string('description',);
            $table->enum('weight',['1', '2', '3', '4', '5', '6']);
            $table->bigInteger('students_id')->unsigned();
            $table->bigInteger('teachers_id')->unsigned()->nullable();
            $table->bigInteger('subjects_id')->unsigned()->nullable();
            $table->bigInteger('classes_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('marks', function (Blueprint $table) {
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade');
        });

        Schema::table('marks', function (Blueprint $table) {
            $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('set null');
        });

        Schema::table('marks', function (Blueprint $table) {
            $table->foreign('subjects_id')->references('id')->on('subjects')->onDelete('set null');
        });

        Schema::table('marks', function (Blueprint $table) {
            $table->foreign('classes_id')->references('id')->on('classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marks');
    }
}
