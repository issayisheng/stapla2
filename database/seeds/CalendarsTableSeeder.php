<?php

use Illuminate\Database\Seeder;

class CalendarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // カレンダーデータ登録
        factory(App\Models\Calendar::class, 5)->create();
    }
}
