<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionCurrenciesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('transaction_currencies', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('currency_id')->nullable();
      $table->foreign('currency_id')->references('id')->on('currencies');
      $table->unsignedBigInteger('transaction_id')->nullable();
      $table->foreign('transaction_id')->references('id')->on('transactions');
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
    Schema::dropIfExists('transaction_currencies');
  }
}
