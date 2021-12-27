<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name', 100);
      $table->string('email')->unique();
      $table->string('password');
      $table->date('birthday');
      $table->float('balance', 8, 2);
      $table->unsignedBigInteger('home_addresses_id')->nullable();
      $table->foreign('home_addresses_id')->references('id')->on('home_addresses');
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
    Schema::dropIfExists('users');
  }
}
