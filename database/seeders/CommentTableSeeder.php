<?php

namespace Database\Seeders;

use App\Models\Comment;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for($i=1;$i<100;$i++)
        {
            $user_id = rand(1,10);
            $post_id = rand(1,9);
            Comment::create([
                'comment'=> $faker->sentence(3),
                'post_id'=> $post_id,
                'user_id'=> $user_id,
            ]);
        }
    }
}
