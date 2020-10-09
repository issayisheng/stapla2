<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_user', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->uuid('calendar_id');
            $table->primary(['calendar_id', 'user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');        // 外部キー制約
            $table->foreign('calendar_id')->references('id')->on('calendars')->onDelete('cascade');// 外部キー制約
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
        Schema::dropIfExists('calendar_user');
    }
}
