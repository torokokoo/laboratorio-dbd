<?php

namespace Database\Factories;

use App\Models\Library;
use App\Models\User;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class LibraryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'game_id' => Game::all()->random()->id
        ];
    }
}
