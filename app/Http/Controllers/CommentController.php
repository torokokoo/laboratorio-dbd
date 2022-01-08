<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $comments = Comment::all();
    if ($comments->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentran comentarios'
      ]);
    }
    return response($comments, 200);
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
        'date' => 'required|date',
        'content' => 'required|min:2|max:200',
        'user_id' => 'required|exists:users,id',
        'game_id' => 'required|exists:games,id'

      ],
      [
        'date.required' => 'Se debe ingresar una fecha valida',
        'content.required' => 'Se debe ingresar un contenido para el comentario',
        'content.min' => 'El comentario debe tener un largo minimo de 2 caracteres',
        'content.max' => 'El comentario excede el maximo de caracteres',
        'user_id.required' => 'El ID del usuario no es valido',
        'game_id.required' => 'El ID del juego no es valido',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $newComment = new Comment();
    $newComment->date = $request->date;
    $newComment->content = $request->content;
    $newComment->user_id = $request->user_id;
    $newComment->game_id = $request->game_id;
    $newComment->save();
    return response()->json([
      'respuesta' => 'Se ha creado un nuevo comentario',
      'id' => $newComment->id
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
    $comment = Comment::find($id);
    if (empty($comment) or $comment->delete == true) {
      return response("404 Not Found", 404);
    }
    return response($comment, 200);
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
        'date' => 'required|date',
        'content' => 'required|min:2|max:200',
        'user_id' => 'required|exists:users,id',
        'game_id' => 'required|exists:games,id'

      ],
      [
        'date.required' => 'Se debe ingresar una fecha valida',
        'content.required' => 'Se debe ingresar un contenido para el comentario',
        'content.min' => 'El comentario debe tener un largo minimo de 2 caracteres',
        'content.max' => 'El comentario excede el maximo de caracteres',
        'user_id.required' => 'El ID del usuario no es valido',
        'game_id.required' => 'El ID del juego no es valido',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }
    $comment = Comment::find($id);
    if (empty($comment) or $comment->delete == true) {
      return response("404 Not Found", 404);
    }
    $comment->date = $request->date;
    $comment->content = $request->content;
    $comment->user_id = $request->user_id;
    $comment->game_id = $request->game_id;
    $comment->save();
    return response()->json(
      [
        'respuesta' => 'Se ha modificado el comentario',
        'id' => $comment->id
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
    $comment = Comment::find($id);
    if (empty($comment) or $comment->delete == true) {
      return response("404 Not Found", 404);
    }
    $comment->delete = true;
    $comment->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado el comentario',
        'id' => $comment->id
      ],
      200
    );
  }
  public function hard_destroy($id)
  {
    $comment = Comment::find($id);
    if (empty($comment)) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $comment->delete();
    return response()->json([
      'mensaje' => 'El comentario ha sido eliminada',
      'id' => $comment->id,
    ], 200);
  }
}
