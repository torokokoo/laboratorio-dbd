<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\User;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'like' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'user_id' => User::all()->random()->id,
            'game_id' => Game::all()->random()->id
        ];
    }
}
