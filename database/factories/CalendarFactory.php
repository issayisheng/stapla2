<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Calendar;
use Faker\Generator as Faker;

$factory->define(Calendar::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'gym_id' => function () {
            return factory(App\Models\Gym::class)->create()->id;
        },
        // 'time' => $faker->time($format = 'H:i', $max = 'now'),
        // 'date' => $faker->dateTimeThisMonth->format('m:d'),
        "created_at" => now(),
        "updated_at" => now(),
    ];
});
