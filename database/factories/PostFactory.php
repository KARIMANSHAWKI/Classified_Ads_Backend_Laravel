<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user =  User::factory()->create();

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'phone' => '01010959072',
            'user_id' => $user->id
        ];
    }
}
