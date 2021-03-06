<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeAddressesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('home_addresses', function (Blueprint $table) {
      $table->id();
      $table->string('address', 200);  # References the complete Address, example: 2120 Grove Street
      $table->integer('number');
      $table->unsignedBigInteger('comuna_id')->nullable();
      $table->foreign('comuna_id')->references('id')->on('comunas');
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
    Schema::dropIfExists('home_addresses');
  }
}
