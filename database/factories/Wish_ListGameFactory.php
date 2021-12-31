<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Wish_list;
use Illuminate\Database\Eloquent\Factories\Factory;

class Wish_ListGameFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'wishlist_id' => Wish_list::all()->random()->id,
      'game_id' => Game::all()->random()->id,
    ];
  }
}
