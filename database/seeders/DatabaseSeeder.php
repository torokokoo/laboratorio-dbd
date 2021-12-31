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
    \App\Models\Comment::factory(10)->create();
    \App\Models\Demo::factory(10)->create();
    \App\Models\AgeRestriction::factory(10)->create();
    \App\Models\Gender::factory(10)->create();
    \App\Models\Url::factory(10)->create();
    \App\Models\Game::factory(10)->create();
  }
}
