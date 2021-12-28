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
      $table->float('price', 4, 2);
      $table->integer('sales');
      $table->string('classification', 50);
      $table->string('valoration', 50);
      $table->float('storage', 4, 2);
      $table->unsignedBigInteger('gender_id')->nullable();
      $table->foreign('gender_id')->references('id')->on('genders');
      $table->unsignedBigInteger('age_restriction_id')->nullable();
      $table->foreign('age_restriction_id')->references('id')->on('age_restrictions');
      $table->unsignedBigInteger('url_id')->nullable();
      $table->foreign('url_id')->references('id')->on('urls');
      $table->unsignedBigInteger('demo_id')->nullable();
      $table->foreign('demo_id')->references('id')->on('demos');
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
