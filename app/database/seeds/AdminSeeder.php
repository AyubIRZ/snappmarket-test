<?php

use \App\User;
use \Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)->create([
            'name' => 'admin',
            'email' => 'admin@site.com',
            'role' => 'admin',
            'password' => Hash::make('admin'),
        ]);
    }
}
