<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gym;
use Faker\Generator as Faker;

$factory->define(Gym::class, function (Faker $faker) {
    return [
        'id' => Str::uuid(),
        'name' => $faker->name,
        'owner_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'zip_code' => $faker->postcode,
        'prefecture' => $faker->prefecture,
        'city' => $faker->city,
        'street' => $faker->streetAddress,
        'building' => $faker->secondaryAddress,
        'gym_facility' => 'ダンベル',
        'tel' => '08012345678',
        "created_at" => now(),
        "updated_at" => now(),
    ];
});
