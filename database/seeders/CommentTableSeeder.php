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
            $post_id = rand(1,10);
            Comment::create([
                'comment'=> $faker->paragraph,
                'post_id'=> $post_id,
                'user_id'=> $user_id,
            ]);
        }
    }
}
