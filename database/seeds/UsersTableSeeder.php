<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <5; $i++) {
            $data[] = [
                'name' => 'ユーザー'.$i,
                'email' => 'user'.$i.'@user.com',
                'tel' => '08012345678',
                'password' => 'password1',
                'uuid' =>  Str::uuid(),
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }
        DB::table('users')->insert($data);
    }
}
