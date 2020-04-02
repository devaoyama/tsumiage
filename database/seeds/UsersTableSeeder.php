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
        factory(\App\User::class, 10)->create()->each(function ($user) {
            $user->config()->save(factory(\App\Config::class)->make());
            $user->date()->save(factory(\App\Date::class)->make());
        });
    }
}
