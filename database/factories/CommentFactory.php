<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_id = 1;//rand(1,10);
        $post_id = 1;//rand(1,10);
        return [
            'comment'=> $this->faker->sentence(3),
            'post_id'=> $post_id,
            'user_id'=> $user_id,
        ];
    }
}
