<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educators', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('teachers_id')->unsigned()->nullable();
            $table->bigInteger('classes_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('educators', function (Blueprint $table) {
            $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('cascade');
        });

        Schema::table('educators', function (Blueprint $table) {
            $table->foreign('classes_id')->references('id')->on('classes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educators');
    }
}
