<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePupilPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pupil_points', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('pupil_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->integer('pupil_point_type_id')->nullable();
            $table->integer('amount');
            $table->text('description');
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
        Schema::dropIfExists('pupil_points');
    }
}
