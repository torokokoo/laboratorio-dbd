<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'content' => $this->faker->realText($maxNbChars = 1000, $indexSize = 2),
      'user1_id' => User::all()->random()->id,
      'user2_id' => User::all()->random()->id
    ];
  }
}
