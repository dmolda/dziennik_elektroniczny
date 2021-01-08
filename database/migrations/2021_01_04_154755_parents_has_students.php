<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ParentsHasStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents_has_students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parents_id')->unsigned();
            $table->bigInteger('students_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('parents_has_students', function (Blueprint $table) {
            $table->foreign('parents_id')->references('id')->on('parents')->onDelete('cascade');
        });

        Schema::table('parents_has_students', function (Blueprint $table) {
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parents_has_students');
    }
}
