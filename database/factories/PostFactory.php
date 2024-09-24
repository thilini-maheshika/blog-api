<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'status' => 'published', // or 'draft', depending on your logic
            'user_id' => \App\Models\User::factory(), // Assuming posts belong to users
        ];
    }
}
