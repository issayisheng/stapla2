<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP');

        DB::table('users')->insert([
            [
                'id' => $faker->uuid,
                'gym_id' => $faker->uuid,
                'tel' => $faker->phoneNumber,
                'name' => '山田 太郎',
                'email' => 'yamada@yamada.net',
                'status' => 0,
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
