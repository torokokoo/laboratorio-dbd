<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $countries = Country::where('delete', false)->get();
    if ($countries->isEmpty()) {
      return response()->json([
        'respuesta' => 'No hay countries'
      ]);
    }
    return response($countries, 200);
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
        'name' => 'required|min:2|max:100',
      ],
      [
        'name.required' => 'Debes ingresar un nombre',
        'name.min' => 'El nombre debe tener un largo minimo de 2',
        'name.max' => 'El nombre excede el numero de caracteres',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $newCountry = new Country();
    $newCountry->name = $request->name;
    $newCountry->save();
    return response()->json([
      'respuesta' => 'Se ha creado una nueva country',
      'id' => $newCountry->id
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
    $country = Country::find($id);
    if (empty($country) or $country->delete) {
      return response()->json([
        'respuesta' => 'No se ha encontrado esa country',
      ]);
    }

    return response($country, 200);
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
        'name' => 'required|min:2|max:100',
      ],
      [
        'name.required' => 'Debes ingresar un nombre',
        'name.min' => 'El nombre debe tener un largo minimo de 2',
        'name.max' => 'El nombre excede el numero de caracteres',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $country = Country::find($id);
    if (empty($country) or $country->delete) {
      return response()->json([
        'respuesta' => 'No se ha encontrado esa country',
      ]);
    }

    $country->name = $request->name;
    $country->save();

    return response()->json(
      [
        'respuesta' => 'Se ha modificado la country',
        'id' => $country->id
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
    $country = Country::find($id);
    if (empty($country) or $country->delete) {
      return response("404 Not Found", 404);
    }
    $country->delete = true;
    $country->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado la country',
        'id' => $country->id
      ],
      200
    );
  }
  public function hard_destroy($id)
  {
    $country = Country::find($id);
    if (empty($country) or $country->delete) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $country->delete();
    return response()->json([
      'respuesta' => 'La country ha sido eliminada',
      'id' => $country->id,
    ], 200);
  }
}
