<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $genders = Gender::all();
    if ($genders->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentra '
      ]);
    }
    return response($genders, 200);
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
        'name' => 'required|min:2|max:100'
      ],
      [

        'name.required' => 'Debes ingresar un genero',
        'name.min' => 'El genero debe tener un largo minimo de 2',
        'name.max' => 'El genero excede el numero de caracteres',
      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $newGender = new Gender();
    $newGender->name = $request->name;
    $newGender->save();
    return response()->json([
      'respuesta' => 'Se ha creado un nuevo genero',
      'id' => $newGender->id
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
    $gender = Gender::find($id);
    if (empty($gender)) {
      $gender = Gender::find($id);
      if (empty($gender) or $gender->delete == true) {
        return response("404 Not Found", 404);
      }
    }
    return response($gender, 200);
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
        'name' => 'required|min:2|max:100'
      ],
      [

        'name.required' => 'Debes ingresar un genero',
        'name.min' => 'El genero debe tener un largo minimo de 2',
        'name.max' => 'El genero excede el numero de caracteres',
      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $gender = Gender::find($id);
    if (empty($gender) or $gender->delete == true) {
      return response("404 Not Found", 404);
    }

    $gender->name = $request->name;
    $gender->save();
    return response()->json(
      [
        'respuesta' => 'Se ha modificado el genero',
        'id' => $gender->id
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
    $gender = Gender::find($id);
    if (empty($gender) or $gender->delete == true) {
      return response("404 Not Found", 404);
    }
    $gender->delete = true;
    $gender->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado el genero',
        'id' => $gender->id
      ],
      200
    );
  }
}
