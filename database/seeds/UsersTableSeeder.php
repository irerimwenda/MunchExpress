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
        $user = User::create([
            'name' => 'Food Ye',
            'email' => 'iloveeating@gmail.com',
            'password' =>  bcrypt('password'),
        ]);

        //Alt Method - But ORM not set up properly(Relationships not set properly)
        /* Restaurant::create([
            'name' => 'Food Palace',
            'location' => 'New York, 1st Avenue, USA',
            'owner_id' => $user->id,
        ]); */

        $user->restaurants()->create([
            'name' => 'Food Palace',
            'location' => 'New York, 1st Avenue, USA',
        ]);

        $user->restaurants()->create([
            'name' => 'Heaven Dishes',
            'location' => 'Tom Mboya, Moi Avenue, Nairobi',
        ]);

        $user->restaurants()->create([
            'name' => 'Chakula Kiasi Sana',
            'location' => 'Ngangairithi, Nyeri, Kenya',
        ]);

        $user->restaurants()->create([
            'name' => 'Kwa Aggie',
            'location' => 'Chania, Miami Street, South Africa',
        ]);
    }
}
