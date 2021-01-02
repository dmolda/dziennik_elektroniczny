<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->enum('time',['1', '2', '3', '4', '5', '6','7','8','9','10','11','12']);
            $table->enum('day',['1', '2', '3', '4', '5']);
            $table->bigInteger('teachers_id')->unsigned();
            $table->bigInteger('subjects_id')->unsigned();
            $table->bigInteger('classes_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('schedules', function (Blueprint $table) {
            $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('cascade');
        });

        Schema::table('schedules', function (Blueprint $table) {
            $table->foreign('subjects_id')->references('id')->on('subjects')->onDelete('cascade');
        });

        Schema::table('schedules', function (Blueprint $table) {
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
        Schema::dropIfExists('schedules');
    }
}
