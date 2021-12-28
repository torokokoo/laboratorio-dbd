<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryGamesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('country_games', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('country_id')->nullable();
      $table->foreign('country_id')->references('id')->on('countries');
      $table->unsignedBigInteger('game_id')->nullable();
      $table->foreign('game_id')->references('id')->on('games');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('country_games');
  }
}
