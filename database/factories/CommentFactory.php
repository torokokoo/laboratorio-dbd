<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Game;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'date' => $this->faker->dateTime($max = 'now', $timezone = null),
      'content' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
      'user_id' => User::all()->random()->id,
      'game_id' => Game::all()->random()->id
    ];
  }
}
