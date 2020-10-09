<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/



$factory->define(User::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'gym_id' => $faker->uuid,
        'tel' => $faker->phoneNumber,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'status' => 5,
        'password' => Hash::make('password'), // password
        'remember_token' => Str::random(10),
        "created_at" => now(),
        "updated_at" => now(),
    ];
});
