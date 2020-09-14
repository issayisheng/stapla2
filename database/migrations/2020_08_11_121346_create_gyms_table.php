<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gyms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('close_id')->nullable();
            $table->integer('owner_id');
            $table->string('name');
            $table->string('zip_code')->nullable();
            $table->string('prefecture')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('building')->nullable();
            $table->string('tel')->nullable();
            $table->string('introduction_pic')->nullable();
            $table->string('introduction_text')->nullable();
            $table->string('gym_facility')->nullable();
            $table->string('picture')->nullable();
            $table->time('mon_opening_started')->nullable();
            $table->time('mon_opening_ended')->nullable();
            $table->time('tue_opening_started')->nullable();
            $table->time('tue_opening_ended')->nullable();
            $table->time('wed_opening_started')->nullable();
            $table->time('wed_opening_ended')->nullable();
            $table->time('thu_opening_started')->nullable();
            $table->time('thu_opening_ended')->nullable();
            $table->time('fri_opening_started')->nullable();
            $table->time('fri_opening_ended')->nullable();
            $table->time('sat_opening_started')->nullable();
            $table->time('sat_opening_ended')->nullable();
            $table->time('sun_opening_started')->nullable();
            $table->time('sun_opening_ended')->nullable();
            $table->time('holi_opening_started')->nullable();
            $table->time('holi_opening_ended')->nullable();
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
        Schema::dropIfExists('gyms');
    }
}
