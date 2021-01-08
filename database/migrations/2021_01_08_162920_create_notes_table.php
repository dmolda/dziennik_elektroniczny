<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('students_id')->unsigned();
            $table->bigInteger('teachers_id')->unsigned();
            $table->enum('type',['positive','negative']);
            $table->text('content');
            $table->timestamps();
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade');
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
