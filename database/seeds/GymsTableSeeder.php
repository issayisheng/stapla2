<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class GymsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP');

        DB::table('gyms')->insert([
            [
                'id' => $faker->uuid,
                'name' => 'PAL烏丸御池',
                'owner_id' => factory(App\User::class)->create()->id,
                'zipcode' => '6040042',
                'address' => '京都市中京区押西洞院町590-5',
                'building' => "ライフプラザ烏丸御池302",
                'introduction_pic' => 'https://lorempixel.com/640/480/cats/?64785',
                'introduction_text' => $faker->realText($maxNbChars = 30, $indexSize = 2),
                'facility' => 'ダンベル',
                'tel' => '07012345678',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'id' => $faker->uuid,
                'name' => 'PAL学芸大学',
                'owner_id' => factory(App\User::class)->create()->id,
                'zipcode' => '1520004',
                'address' => '東京都目黒区鷹番2-15-18',
                'building' => "ホワイトガーデン404",
                'introduction_pic' => 'https://lorempixel.com/640/480/sports/?64785',
                'introduction_text' => $faker->realText($maxNbChars = 30, $indexSize = 2),
                'facility' => '鉄アレイ',
                'tel' => '08012345678',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'id' => $faker->uuid,
                'name' => 'PAL豊中',
                'owner_id' => factory(App\User::class)->create()->id,
                'zipcode' => '5600056',
                'address' => '大阪府豊中市宮山町1-1-48',
                'building' => "サンクレール宮山 1F",
                'introduction_pic' => 'https://lorempixel.com/640/480/nature/?64785',
                'introduction_text' => $faker->realText($maxNbChars = 30, $indexSize = 2),
                'facility' => 'バランスボール',
                'tel' => '09012345678',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
