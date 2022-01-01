<?php

namespace Database\Factories;

use App\Models\WishListGame;
use App\Models\Game;
use App\Models\WishList;
use Illuminate\Database\Eloquent\Factories\Factory;

class WishListGameFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'game_id' => Game::all()->random()->id,
      'wishlist_id' => WishList::all()->random()->id
    ];
  }
}
