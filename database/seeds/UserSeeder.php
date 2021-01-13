<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 4)->create()
        ->each(function($user){
            $user->roles()->save(factory(App\Role::class)->make());
        });
    }
}
