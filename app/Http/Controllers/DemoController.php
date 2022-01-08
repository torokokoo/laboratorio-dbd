<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Demo;
use Illuminate\Support\Facades\Validator;


class DemoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $demos = Demo::all();
    if ($demos->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentra '
      ]);
    }
    return response($demos, 200);
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
        'link' => 'required|min:2|max:100',
      ],
      [
        'link.required' => 'Debes ingresar un link',
        'link.min' => 'El link debe tener un largo minimo de 2',
        'link.max' => 'El linke xcede el numero de caracteres',
      ]
    );
    if ($validator->fails()) {
      return response($validator->errors(), 400);
    }
    $newDemo = new Demo();
    $newDemo->link = $request->link;
    $newDemo->save();

    return response()->json([
      'respuesta' => 'Se ha creado una nueva demo',
      'id' => $newDemo->id
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
    $demo = Demo::find($id);
    if (empty($demo) or $demo->delete == true) {
      return response("404 Not Found", 404);
    }
    return response($demo, 200);
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
        'link' => 'required|min:2|max:100'
      ],
      [

        'link.required' => 'Debes ingresar un link',
        'link.min' => 'El link debe tener un largo minimo de 2',
        'link.max' => 'El linke xcede el numero de caracteres',
      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $demo = Demo::find($id);
    if (empty($demo) or $demo->delete == true) {
      return response("404 Not Found", 404);
    }

    $demo->link = $request->link;
    $demo->save();
    return response()->json(
      [
        'respuesta' => 'Se ha modificado la demo',
        'id' => $demo->id
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
    $demo = Demo::find($id);
    if (empty($demo) or $demo->delete == true) {
      return response("404 Not Found", 404);
    }
    $demo->delete = true;
    $demo->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado la demo',
        'id' => $demo->id
      ],
      200
    );
  }
  public function hard_destroy($id)
  {
    $demo = Demo::find($id);
    if (empty($demo)) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $demo->delete();
    return response()->json([
      'mensaje' => 'La demo ha sido eliminada',
      'id' => $demo->id,
    ], 200);
  }
}
