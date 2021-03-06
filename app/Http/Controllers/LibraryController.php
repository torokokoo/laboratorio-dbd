<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Library;
use App\Models\Game;
use Illuminate\Support\Facades\Validator;

class LibraryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $libraries = Library::where('delete', false)->get();
    if ($libraries->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentran librerias'
      ]);
    }
    return response($libraries, 200);
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
        'user_id' => 'required|exists:users,id',
        'game_id' => 'required|exists:games,id'

      ],
      [
        'user_id.required' => 'El ID del usuario no es valido',
        'game_id.required' => 'El ID del jueugo no es valido',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $newLibrary = new Library();
    $newLibrary->user_id = $request->user_id;
    $newLibrary->gender_id = $request->gender_id;
    $newLibrary->save();
    return response()->json([
      'respuesta' => 'Se ha creado una nueva biblioteca',
      'id' => $newLibrary->id
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
    $library = Library::where('user_id', $id)->get();
    if (empty($library)) {
      return response("404 Not Found", 404);
    }

    # Aqui me encantaria usar un map, pero en PHP es demasiado complicado xD
    $ids = [];
    foreach ($library as $item) {
      array_push($ids, $item->game_id);
    }

    $games = Game::whereIn('id', $ids)->get();
    return view('library', compact('games'));
    return response($library, 200);
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
        'user_id' => 'required|exists:users,id',
        'game_id' => 'required|exists:games,id'

      ],
      [
        'user_id.required' => 'El ID del usuario no es valido',
        'game_id.required' => 'El ID del jueugo no es valido',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }
    $library = Library::find($id);
    if (empty($library) or $library->delete) {
      return response("404 Not Found", 404);

      $library->user_id = $request->user_id;
      $library->game_id = $request->game_id;
      $library->save();
      return response()->json(
        [
          'respuesta' => 'Se ha modificado la biblioteca',
          'id' => $library->id
        ],
        200
      );
    }
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $library = Library::find($id);
    if (empty($library) or $library->delete) {
      return response("404 Not Found", 404);
    }
    $library->delete = true;
    $library->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado la biblioteca',
        'id' => $library->id
      ],
      200
    );
  }
  public function hard_destroy($id)
  {
    $library =  Library::find($id);
    if (empty($library) or $library->delete) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $library->delete();
    return response()->json([
      'mensaje' => 'La libreria ha sido eliminada',
      'id' => $library->id,
    ], 200);
  }
}
