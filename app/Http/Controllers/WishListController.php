<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WishList;
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
    $wishlists = WishList::all();
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

    $newWishList = new WishList();
    $newWishList->privacy = $request->privacy;
    $newWishList->user_id = $request->user_id;
    $newWishList->save();
    return response()->json([
      'respuesta' => 'Se ha creado una nueva lista de deseos',
      'id' => $newWishList->id
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
    $wishlist = WishList::find($id);
    if (empty($wishlist) or $wishlist->delete == true) {
      return response("404 Not Found", 404);
    }
    return response($wishlist, 200);
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
    if (empty($wishlist) or $wishlist->delete == true) {
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
    if (empty($wishlist) or $wishlist->delete == true) {
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
    if (empty($wishlist)) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $wishlist->delete();
    return response()->json([
      'mensaje' => 'La lista de deseos ha sido eliminado',
      'id' => $wishlist->id,
    ], 200);
  }
}
