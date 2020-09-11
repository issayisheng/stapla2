<?php

use Illuminate\Database\Seeder;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class UsersTableSeeder extends Seeder
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
                'gym_id' => $i,
                'name' => 'ユーザー'.$i,
                'email' => 'test'.$i.'@test.com',
                'tel' => '08012345678',
                'password' => Hash::make('password'),
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }
        DB::table('users')->insert($data);
    }
}
