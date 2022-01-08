<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgeRestriction;
use Illuminate\Support\Facades\Validator;

class AgeRestrictionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $AgeRestricions = AgeRestriction::all();
    if ($AgeRestricions->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentra '
      ]);
    }
    return response($AgeRestricions, 200);
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
        'age_restriction' => 'required|min:1|max:100'
      ],
      [
        'age_restriction.required' => 'Debes ingresar una restriccion de edad',
        'age_restriction.min' => 'La restriccion de edad debe tener un largo minimo de 2',
        'age_restriction.max' => 'La restriccion de edad excede el numero de caracteres',
      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $newAgeRestricion = new AgeRestriction();
    $newAgeRestricion->age_restriction = $request->age_restriction;
    $newAgeRestricion->save();
    return response()->json([
      'respuesta' => 'Se ha creado una nueva restriccion de edad',
      'id' => $newAgeRestricion->id
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
    $AgeRestricion = AgeRestriction::find($id);
    if (empty($ageRestricion) or $ageRestricion->delete == true) {
      return response("404 Not Found", 404);
    }
    return response($AgeRestricion, 200);
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
        'age_restriction' => 'required|min:2|max:100'
      ],
      [

        'age_restriction.required' => 'Debes ingresar una restriccion de edad',
        'age_restriction.min' => 'La restriccion de edad debe tener un largo minimo de 2',
        'age_restriction.max' => 'La restriccion de edad excede el numero de caracteres',
      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $ageRestricion = AgeRestriction::find($id);
    if (empty($ageRestricion) or $ageRestricion->delete == true) {
      return response("404 Not Found", 404);
    }

    $ageRestricion->link = $request->link;
    $ageRestricion->save();
    return response()->json(
      [
        'respuesta' => 'Se ha modificado la restriccion de edad',
        'id' => $ageRestricion->id
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
    $ageRestricion = AgeRestriction::find($id);
    if (empty($ageRestricion) or $ageRestricion->delete == true) {
      return response("404 Not Found", 404);
    }
    $ageRestricion->delete = true;
    $ageRestricion->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado la restricion de edad',
        'id' => $ageRestricion->id
      ],
      200
    );
  }
  public function hard_destroy($id)
  {
    $ageRestricion = AgeRestriction::find($id);
    if (empty($ageRestricion)) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $ageRestricion->delete();
    return response()->json([
      'mensaje' => 'La restriccion de edad ha sido eliminada',
      'id' => $ageRestricion->id,
    ], 200);
  }
}
