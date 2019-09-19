<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create default user
        User::create([
            'name' => 'Food Ye',
            'email' => 'iloveeating@gmail.com',
            'password' =>  bcrypt('password'),
        ]);
    }
}
