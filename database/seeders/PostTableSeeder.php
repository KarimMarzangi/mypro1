<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        // $title = $faker->sentence(2);
        // dd($title);
        
        for($i=1;$i<10;$i++)
        {
            $user_Id = rand(1,10);
            Post::create([
                'title'=> $faker->sentence(2), 
                'description' => $faker->paragraph,
                'user_id' => $user_Id,
            ]);
        }
    }
}
