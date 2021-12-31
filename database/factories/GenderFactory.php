<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GenderFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name' => $this->faker->randomElement($array = array('Action', 'Sports', 'Simulation', 'Strategy', 'Idle', 'Adventure', 'Fighting', 'Beat-em up', 'JRPG', 'Visual Novel', 'Metroidvania', 'Survival Horror', 'Shooter'))
    ];
  }
}
