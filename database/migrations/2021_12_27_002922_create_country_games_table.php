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
            $table->unsignedBigInteger('country')->nullable();
            $table->foreign('country')->references('id')->on('countries');
            $table->unsignedBigInteger('game')->nullable();
            $table->foreign('game')->references('id')->on('games');
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
