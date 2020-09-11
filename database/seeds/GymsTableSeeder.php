<?php

use Illuminate\Database\Seeder;

class GymsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 8; $i++) {
            $data[] = [
                'id' => Str::uuid(),
                'name' => 'ジム'.$i,
                'zip_code' => '0123456',
                'prefecture' => 'tokyo',
                'city' => 'shibuya',
                'street' => 'hoge1-2-3',
                'building' => 'false404',
                'gym_facility' => 'ダンベル',
                'tel' => '08012345678',
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }
        DB::table('gyms')->insert($data);
    }
}
