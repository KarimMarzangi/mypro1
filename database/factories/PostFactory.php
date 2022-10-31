<?php

namespace Database\Factories;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_Id = 1;
        return [
                'title'=> $this->faker->title, 
                'description' => $this->faker->paragraph,
                'user_id' => $user_Id,
        ];
    }
}
