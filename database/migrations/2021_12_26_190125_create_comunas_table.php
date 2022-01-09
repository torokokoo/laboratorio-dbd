<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComunasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('comunas', function (Blueprint $table) {
      $table->id();
      $table->string('name', 100);
      $table->unsignedBigInteger('region_id')->nullable();
      $table->foreign('region_id')->references('id')->on('regions');
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
    Schema::dropIfExists('comunas');
  }
}
