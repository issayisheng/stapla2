<?php

use Illuminate\Database\Seeder;
use App\Models\Calendar;
use App\Models\Gym;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class CalendarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP');

        // 全件削除する
        Calendar::query()->delete();
        
        // Create an empty array and save the transformed input to array
        $dataToInsert = [];
        
        // Get the date range
        // @NOTE - update the start and end date as per your choice

        // 期間
        $dates = CarbonPeriod::create('2020-09-01', '2020-12-31');

        // 予約可能時間繰り返し
        // $times = CarbonPeriod::since('09:00')->minutes(30)->until('22:00')->toArray();
        $times = CarbonPeriod::since('09:00')->minutes(90)->until('22:00')->toArray();

        // ジムの店舗数
        $gyms = Gym::select('id')->get();

        // For each dates create a transformed data
        foreach ($gyms as $gym) {
            foreach ($dates as $date) {
                foreach ($times as $time) {
                    // Main transformer
                    $dataToInsert[] = [
                    'id' => $faker->uuid,
                    'gym_id' =>  $gym->id,
                    'date' => $date->format('Y-m-d'),
                    'time' => $time,
                    'day' => $date->day,
                    'month' => $date->month,
                    'year' => $date->year,
                    'day_name_ja' => $date->isoFormat('ddd'),
                    'day_name_en' => $date->format('l'),
                    'is_saturday' => (int) $date->isSaturday(),
                    'is_sunday' => (int) $date->isSunday(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                }
            }
        }
        
        

    
        // Create chunks for faster insertion
        // @note - SQL Server supports a maximum of 2100 parameters.
        $chunks = collect($dataToInsert)->chunk(50);
        
        // Using chunks insert the data
        foreach ($chunks as $chunk) {
            Calendar::insert($chunk->toArray());
        }
    }
}
