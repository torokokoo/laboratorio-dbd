<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $likes = Like::where('delete', false)->get();
    if ($likes->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentran likes'
      ]);
    }
    return response($likes, 200);
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
        'like' => 'required|min:2|max:50',
        'user_id' => 'required|exists:urls,id',
        'game_id' => 'required|exists:demos,id'

      ],
      [
        'like.required' => 'Debes ingresar un True si das like o un False en caso contrario',
        'user_id.required' => 'El ID del usuario no es valido',
        'game_id.required' => 'El ID del juego no es valido',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $newLike = new Like();
    $newLike->like = $request->like;
    $newLike->user_id = $request->user_id;
    $newLike->game_id = $request->game_id;
    $newLike->save();
    return response()->json([
      'respuesta' => 'Se ha creado un nuevo like',
      'id' => $newLike->id
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
    $like = Like::find($id);
    if (empty($like) or $like->delete) {
      return response("404 Not Found", 404);
    }
    return response($like, 200);
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
        'like' => 'required|min:2|max:50',
        'user_id' => 'required|exists:urls,id',
        'game_id' => 'required|exists:demos,id'

      ],
      [
        'like.required' => 'Debes ingresar un True si das like o un False en caso contrario',
        'user_id.required' => 'El ID del usuario no es valido',
        'game_id.required' => 'El ID del juego no es valido',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }
    $like = Like::find($id);
    if (empty($like) or $like->delete) {
      return response("404 Not Found", 404);
    }
    $like->like = $request->like;
    $like->user_id = $request->user_id;
    $like->game_id = $request->game_id;
    $like->save();
    return response()->json(
      [
        'respuesta' => 'Se ha modificado el like',
        'id' => $like->id
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
    $like = Like::find($id);
    if (empty($like) or $like->delete) {
      return response("404 Not Found", 404);
    }
    $like->delete = true;
    $like->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado el like',
        'id' => $like->id
      ],
      200
    );
  }
  public function hard_destroy($id)
  {
    $like = Like::find($id);
    if (empty($like) or $like->delete) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $like->delete();
    return response()->json([
      'mensaje' => 'El like ha sido eliminado',
      'id' => $like->id,
    ], 200);
  }
}
