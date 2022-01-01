<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'user_id' => User::all()->random()->id,
            'game_id' => Game::all()->random()->id
        ];
    }
}
