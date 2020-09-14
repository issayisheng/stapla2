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
        factory(App\User::class, 5)->create();
    }
}
