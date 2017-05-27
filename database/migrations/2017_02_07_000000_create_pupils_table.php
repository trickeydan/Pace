<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePupilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pupils', function (Blueprint $table) {
            $table->increments('id');
            $table->string('forename'); // Forename of the pupil.
            $table->string('surname'); // Forename of the pupil.
            $table->integer('adno'); // Adno of the pupil.
            $table->integer('currPoints'); //Cached points for this pupil
            $table->integer('tutorgroup_id')->nullable(); //
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
        Schema::dropIfExists('pupils');
    }
}
