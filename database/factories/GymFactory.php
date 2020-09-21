<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gym;
use Faker\Generator as Faker;

$factory->define(Gym::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'name' => $faker->randomElement(['PAL烏丸御池','PAL学芸大学','PAL豊中']),
        'owner_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'zipcode' => $faker->randomElement(['604-0042','152-0004','560-0056']),
        'building' => $faker->randomElement(["ライフプラザ烏丸御池302",'ホワイトガーデン404','サンクレール宮山 1F']),
        'introduction_pic' => $faker->imageUrl($width = 640, $height = 480, $category = 'cats', $randomize = true, $word = null),
        'introduction_text' => $faker->realText($maxNbChars = 30, $indexSize = 2),
        'facility' => 'ダンベル',
        'tel' => '08012345678',
        "created_at" => now(),
        "updated_at" => now(),
    ];
});
