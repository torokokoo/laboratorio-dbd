<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $messages = Message::where('delete', false)->get();
    if ($messages->isEmpty()) {
      return response()->json([
        'respuesta' => 'No existe mensaje'
      ]);
    }
    return response($messages, 200);
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
        'contenido' => 'required|min:2|max:1000',
        'user1_id' => 'required|exists:users,id',
        'user2_id' => 'required|exists:games,id',

      ],
      [
        'contenido.required' => 'Debes ingresar un mensaje',
        'contenido.min' => 'El mensaje debe tener un largo minimo de 2',
        'contenido.max' => 'El mensaje excede el numero de caracteres',
      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $newMessage = new Message();
    $newMessage->contenido = $request->contenido;
    $newMessage->user1_id = $request->user1_id;
    $newMessage->user2_id = $request->user2_id;
    $newMessage->save();
    return response()->json([
      'respuesta' => 'Se ha creado un nuevo mensaje',
      'id' => $newMessage->id
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
    $message = Message::find($id);
    if (empty($message) or $message->delete) {
      return response()->json([
        'respuesta' => 'No se ha encontrado un mensaje',
      ]);
    }

    return response($message, 200);
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
        'contenido' => 'required|min:2|max:1000',
        'user1_id' => 'required|exists:users,id',
        'user2_id' => 'required|exists:games,id',
      ],
      [

        'contenido.required' => 'Debes ingresar un mensaje',
        'contenido.min' => 'El mensaje debe tener un largo minimo de 2',
        'contenido.max' => 'El mensaje excede el numero de caracteres',


      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $message = Message::find($id);
    if (empty($message) or $message->delete) {
      return response("404 Not Found", 404);
    }

    $message->user1_id = $request->user1_id;
    $message->user2_id = $request->user2_id;
    $message->save();
    return response()->json(
      [
        'respuesta' => 'Se ha modificado  el mensaje',
        'id' => $message->id
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
    $message = Message::find($id);
    if (empty($message) or $message->delete) {
      return response("404 Not Found", 404);
    }
    $message->delete = true;
    $message->save();
    return response()->json(
      [
        'respuesta' => 'Se ha borrado el mensaje',
        'id' => $message->id
      ],
      200
    );
  }
  public function hard_destroy($id)
  {
    $message = Message::find($id);
    if (empty($message) or $message->delete) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $message->delete();
    return response()->json([
      'mensaje' => 'El mensaje ha sido eliminado',
      'id' => $message->id,
    ], 200);
  }
}
