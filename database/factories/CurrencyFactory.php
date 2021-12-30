<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name' => $this->faker->currencyCode,
      'USdollarExchange' => $this->faker->numberBetween($min = 0, $max = 5000)
    ];
  }
}
