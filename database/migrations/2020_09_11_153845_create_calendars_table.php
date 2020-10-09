<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->uuid('id')->primary();  //primary
            $table->uuid('user_id')->nullable();
            $table->uuid('gym_id')->nullable();
            $table->foreign('gym_id')->references('id')->on('gyms');
            $table->boolean('reserved')->default(false);
            $table->integer('status')->default(0);   // 0未予約  // 1予約済み  // 2完了 // 10キャンセル
            $table->time('time');
            $table->date('date');
            $table->unsignedInteger('day');
            $table->unsignedInteger('month');
            $table->unsignedInteger('year');
            $table->string('day_name_ja');
            $table->string('day_name_en');
            $table->unsignedInteger('is_saturday');
            $table->unsignedInteger('is_sunday');
            $table->date('first_day_of_month');
            $table->date('last_day_of_month');
            $table->date('first_day_of_next_month');
            $table->date('first_day_of_year');
            $table->date('last_day_of_year');
            $table->date('first_day_of_next_year');
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
        Schema::dropIfExists('calendars');
    }
}
