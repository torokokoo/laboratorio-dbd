<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WishListGame;
use Illuminate\Support\Facades\Validator;

class WishListGameController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $wishListGames = WishListGame::where('delete', false)->get();
    if ($wishListGames->isEmpty()) {
      return response()->json([
        'respuesta' => 'No hay nada en la relacion wishList-game'
      ]);
    }
    return response($wishListGames, 200);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function store(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'wishlist_id' => 'required|exists:wishlists,id',
        'game_id' => 'required|exists:games,id'
      ],
      [
        'wishlist_id.required' => 'Debes ingresar un id1',
        'wishlist_id.integer' => 'Debes ingresar un id1 valido',
        'game_id.required' => 'Debes ingresar un id2',
        'game_id.integer' => 'Debes ingresar un id2 valido',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $newWishListGame = new WishListGame();
    $newWishListGame->wishlist_id = $request->wishlist_id;
    $newWishListGame->game_id = $request->game_id;
    $newWishListGame->save();
    return response()->json([
      'respuesta' => 'Se ha creado una nueva relacion wishList-game',
      'id' => $newWishListGame->id
    ], 201);
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $wishListGame = WishListGame::find($id);
    if (empty($wishListGame) or $wishListGame->delete) {
      return response()->json([
        'respuesta' => 'No se ha encontrado esa relacion wishList-game',
      ]);
    }

    return response($wishListGame, 200);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'wishlist_id' => 'required|exists:wishlists,id',
        'game_id' => 'requiredF|exists:games,id'
      ],
      [
        'wishlist_id.required' => 'Debes ingresar un id1',
        'wishlist_id.integer' => 'Debes ingresar un id1 valido',
        'game_id.required' => 'Debes ingresar un id2',
        'game_id.integer' => 'Debes ingresar un id2 valido',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $wishListGame = WishListGame::find($id);
    if (empty($wishListGame) or $wishListGame->delete) {
      return response()->json([
        'respuesta' => 'No se ha encontrado esa relacion wishList-game',
      ]);
    }

    $wishListGame->wishlist_id = $request->wishlist_id;
    $wishListGame->game_id = $request->game_id;
    $wishListGame->save();

    return response()->json(
      [
        'respuesta' => 'Se ha modificado la relacion wishList-game',
        'id' => $wishListGame->id
      ],
      200
    );
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function destroy($id)
  {
    $wishListGame = WishListGame::find($id);
    if (empty($wishlist) or $wishListGame->delete) {
      return response("404 Not Found", 404);
    }
    $wishListGame->delete = true;
    $wishListGame->save();
    return response()->json(
      [
        'respuesta' => 'Se ha borrado el rol de usuario',
        'id' => $wishListGame->id
      ],
      200
    );
  }
  public function hard_destroy($id)
  {
    $wishListGame = WishListGame::find($id);
    if (empty($wishListGame) or $wishListGame->delete) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $wishListGame->delete();
    return response()->json([
      'mensaje' => 'La lista de deseos ha sido eliminado',
      'id' => $wishListGame->id,
    ], 200);
  }
}
