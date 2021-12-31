<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
      'user1_id' => User::all()->random()->id,
      'user2_id' => User::all()->random()->id,
    ];
  }
}
