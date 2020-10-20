<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('second_name')->nullable();
            $table->text('last_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->set('sex',['kobieta','mężczyzna'])->nullable();
            $table->bigInteger('users_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('teachers', function (Blueprint $table){

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
