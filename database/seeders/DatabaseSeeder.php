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
    \App\Models\Currency::factory(25)->create();
    \App\Models\Demo::factory(25)->create();
    \App\Models\Url::factory(25)->create();
    \App\Models\Permission::factory(25)->create();
    \App\Models\Role::factory(3)->create();
    \App\Models\RolePermission::factory(25)->create();
    \App\Models\AgeRestriction::factory(25)->create();
    \App\Models\Gender::factory(25)->create();
    \App\Models\Game::factory(25)->create();
    \App\Models\GameGender::factory(25)->create();
    \App\Models\Country::factory(25)->create();
    \App\Models\CountryGame::factory(25)->create();
    \App\Models\Region::factory(25)->create();
    \App\Models\Comuna::factory(25)->create();
    \App\Models\HomeAddress::factory(25)->create();
    \App\Models\User::factory(25)->create();
    \App\Models\Message::factory(25)->create();
    \App\Models\UserFollower::factory(100)->create();
    \App\Models\Transaction::factory(25)->create();
    \App\Models\Comment::factory(25)->create();
    \App\Models\Like::factory(25)->create();
    \App\Models\Library::factory(25)->create();
    \App\Models\WishList::factory(25)->create();
    \App\Models\WishListGame::factory(25)->create();
  }
}
