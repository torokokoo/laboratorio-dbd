<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('games', function (Blueprint $table) {
      $table->id();
      $table->string('name', 50);
      $table->string('description', 1000);
      $table->float('price', 4, 2)->default(0);
      $table->float('storage', 4, 2)->default(0);
      $table->text('image');
      $table->unsignedBigInteger('age_restriction_id')->nullable();
      $table->foreign('age_restriction_id')->references('id')->on('age_restrictions');
      $table->unsignedBigInteger('url_id')->nullable();
      $table->foreign('url_id')->references('id')->on('urls');
      $table->unsignedBigInteger('demo_id')->nullable()->default(0);
      $table->unsignedBigInteger('soldUnits')->nullable();
      $table->foreign('demo_id')->references('id')->on('demos');
      $table->boolean('delete')->default(false);
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
    Schema::dropIfExists('games');
  }
}
