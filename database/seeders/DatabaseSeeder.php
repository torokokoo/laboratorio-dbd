<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    \App\Models\Currency::factory(10)->create();
    \App\Models\Demo::factory(10)->create();
    \App\Models\Url::factory(10)->create();
    \App\Models\Permission::factory(10)->create();
    \App\Models\Role::factory(3)->create();
    \App\Models\RolePermission::factory(10)->create();
    \App\Models\AgeRestriction::factory(10)->create();
    \App\Models\Gender::factory(10)->create();
    \App\Models\Game::factory(10)->create();
    \App\Models\GameGender::factory(10)->create();
    \App\Models\Country::factory(10)->create();
    \App\Models\CountryGame::factory(10)->create();
    \App\Models\Region::factory(10)->create();
    \App\Models\Comuna::factory(10)->create();
    \App\Models\HomeAddress::factory(10)->create();
    \App\Models\User::factory(10)->create();
    \App\Models\Message::factory(10)->create();
    \App\Models\UserFollower::factory(10)->create();
    \App\Models\Transaction::factory(10)->create();
    \App\Models\Comment::factory(10)->create();
    \App\Models\Like::factory(10)->create();
    \App\Models\Library::factory(10)->create();
    /** Los seeders de Wishlist funcionan perfectamente
    * pero lo optimo es que cada usuario cree su lista de deseos 
    * para mostrar su funcionamiento
    * \App\Models\WishList::factory(10)->create();
    * \App\Models\WishListGame::factory(10)->create();
    */
  }
}
