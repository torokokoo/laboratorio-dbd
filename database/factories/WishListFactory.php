<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WishList;
use App\Models\User;

class WishListFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'privacy' => $this->faker->randomElement(['public', 'private']),
      'user_id' => User::all()->random()->id
    ];
  }
}
