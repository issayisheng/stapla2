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
            $table->uuid('id')->primary();            // Primary key.
            $table->uuid('owner_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('users'); // 外部キー参照
            $table->string('name')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('address')->nullable();
            $table->string('building')->nullable();
            $table->string('tel')->nullable();
            $table->string('introduction_pic')->nullable();
            $table->string('introduction_text')->nullable();
            $table->string('facility')->nullable();
            $table->boolean('delete_flag')->default(false);
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
            $table->softDeletes(); // 論理削除
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
