<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Url;
use App\Models\Demo;
use App\Models\AgeRestriction;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name' => $this->faker->name,
      'description' => $this->faker->realText($maxNbChars = 500, $indexSize = 2),
      'price' => $this->faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = NULL),
      'storage' => $this->faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = 50),
      'image' => $this->faker->randomElement($array = array('https://bit.ly/3KodRvh', 'https://bit.ly/3FESEKg', 'https://bit.ly/3IfRG8J', 'https://bit.ly/3rzwXX3', 'https://bit.ly/3KomrKQ', 'https://bit.ly/3ruALsz', 'https://bit.ly/3fEzqtI', 'https://bit.ly/32eZW9S', 'https://bit.ly/3Ihw8Zz')),
      'video' => $this->faker->randomElement($array = array('https://www.youtube.com/embed/edYCtaNueQY', 'https://www.youtube.com/embed/7zwQPJmg-Kg', 'https://www.youtube.com/embed/hvoD7ehZPcM', 'https://www.youtube.com/embed/UAO2urG23S4', 'https://www.youtube.com/embed/4eBy0woHWjA', 'https://www.youtube.com/embed/6SRj82vc1Jg', 'https://www.youtube.com/embed/HqQMh_tij0c', 'https://www.youtube.com/embed/1Hojv0m3TqA', 'https://www.youtube.com/embed/MmB9b5njVbA')),
      'age_restriction_id' => AgeRestriction::all()->random()->id,
      'soldUnits' => $this->faker->numberBetween($min = 1000, $max = 50000),
      'url_id' => Url::all()->random()->id,
      'demo_id' => Demo::all()->random()->id
    ];
  }
}
