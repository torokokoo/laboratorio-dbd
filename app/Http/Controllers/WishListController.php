<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use App\Models\WishListGame;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WishListController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $wishlists = WishList::where('delete', false)->get();
    if ($wishlists->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentran listas de deseos'
      ]);
    }
    return response($wishlists, 200);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $games = Game::all();
    return view('createWishlist', compact('games'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $id)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'name' => 'required',
        'privacy' => 'required|min:2|max:50',
      ],
      [
        'name.required' => 'Debes ingresar un nombre valido',
        'privacy.required' => 'Debes ingresar una privacidad valida',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $newWishList = new WishList();
    $newWishList->name = $request->name;
    $newWishList->privacy = $request->privacy;
    $newWishList->user_id = $_COOKIE['id'];
    $newWishList->save();

    return redirect(sprintf('/wishlists/%s', $_COOKIE['id']));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $wishlists = WishList::where('user_id', $id)->get();
    return view('wishlists', compact('wishlists'));
  }

  public function showById($id)
  {
    $wishlists = WishListGame::where('wishlist_id', $id)->get();
    
    $ids = [];
    foreach ($wishlists as $item) {
      array_push($ids, $item->game_id);
    }

    $games = Game::whereIn('id', $ids)->get();
    return view('wishlist', compact('games'))->with('id', $id);
  }

  public function addGameRender($id) {
    $games = Game::all();
    return view('addGameWishlist', compact('games'));
  }

  public function addGame(Request $request, $id) {
    $wishListGame = new WishListGame();
    $wishListGame->game_id = $request->game_id;
    $wishListGame->wishlist_id = $id;
    $wishListGame->save();

    return redirect('/');

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
        'privacy' => 'required|min:2|max:50',
        'user_id' => 'required|exists:users,id'
      ],
      [
        'privacy.required' => 'Debes ingresar una privacidad valida',
        'user_id.exists' => 'El ID del usuario no es valido',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }
    $wishlist = WishList::find($id);
    if (empty($wishlist) or $wishlist->delete) {
      return response("404 Not Found", 404);
    }
    $wishlist->privacy = $request->privacy;
    $wishlist->user_id = $request->user_id;
    $wishlist->save();
    return response()->json(
      [
        'respuesta' => 'Se ha modificado la lista de deseos',
        'id' => $wishlist->id
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
    $wishlist = WishList::find($id);
    if (empty($wishlist) or $wishlist->delete) {
      return response("404 Not Found", 404);
    }
    $wishlist->delete = true;
    $wishlist->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado la lista de deseos',
        'id' => $wishlist->id
      ],
      200
    );
  }
  public function hard_destroy($id)
  {
    $wishlist = WishList::find($id);
    if (empty($wishlist) or $wishlist->delete) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $wishlist->delete();
    return redirect(sprintf('/wishlists/%s', $_COOKIE['id']));
  }

  public function game_hard_destroy($wishlist, $relation)
  {
    $wishlist = WishListGame::where([
      ['wishlist_id', '=', $wishlist],
      ['game_id', '=', $relation],
    ]);
    if (empty($wishlist) or $wishlist->delete) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $wishlist->delete();
    return redirect(sprintf('/wishlist/%s', $wishlist));
  }
}
