<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->integer('participant_id');
            $table->string('participant_type');
            $table->integer('amount');
            $table->text('description')->nullable();
            $table->boolean('affectTotals');
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
        Schema::drop('event_points');
    }
}
