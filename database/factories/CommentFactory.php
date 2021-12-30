<?php

namespace Database\Factories;

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
      'content' => $this->faker->realText($maxNbChars = 200, $indexSize = 2)
    ];
  }
}
