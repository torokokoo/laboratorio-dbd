<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Wish_List;
use App\Models\User;

class Wish_ListFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'privacy' => $this->faker->name,
      'user_id' => User::all()->random()->id
    ];
  }
}
