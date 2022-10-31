<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['user', 'moderator', 'admin'];
        $faker = Factory::create();
        for($i=0;$i<10;$i++)
        {
            $name = $faker->name();
            $surname = $faker->lastName();
            $username = $surname.(substr($name,0,3));
            $type = random_int(0,2);
            User::create([
                'name' => $name,
                'surname' => $surname,
                'nickname' => $faker->name,
                'username' => $username,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'city' => $faker->city(),
                'state' =>$faker->city(),
                'zip' => $faker->postcode ,
                'type'=> $types[$type],
                'email' => $faker->safeEmail(),
                'password' => bcrypt('password'),
            ]);
    }
}
}
