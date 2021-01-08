<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('second_name')->nullable();
            $table->text('last_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->set('sex',['kobieta','mężczyzna'])->nullable();
            $table->bigInteger('users_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('parents', function (Blueprint $table){

            $table->foreign('users_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parents');
    }
}
