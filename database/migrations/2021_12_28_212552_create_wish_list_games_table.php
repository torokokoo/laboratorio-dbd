<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishListGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wish_list_games', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('game_id')->nullable();
            $table->foreign('game_id')->references('id')->on('games');

            $table->unsignedBigInteger('wishlist_id')->nullable();
            $table->foreign('wishlist_id')->references('id')->on('wish_lists');

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
        Schema::dropIfExists('wish_list_games');
    }
}
