<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeAddress;
use Illuminate\Support\Facades\Validator;

class HomeAddressController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $homeAddresses = HomeAddress::where('delete', false)->get();
    if ($homeAddresses->isEmpty()) {
      return response()->json([
        'respuesta' => 'No hay homeAddresses'
      ]);
    }
    return response($homeAddresses, 200);
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
        'address' => 'required|min:2|max:100',
        'comuna_id' => 'required|exists:comunas,id',
        'number' => 'required|integer'
      ],
      [
        'address.required' => 'Debes ingresar un nombre',
        'address.min' => 'El nombre debe tener un largo minimo de 2',
        'address.max' => 'El nombre excede el numero de caracteres',
        'comuna_id.exists' => 'El ID comuna no existe',
        'number.required' => 'Debes ingresar un number',
        'number.integer' => 'El numero de casa debe ser un int',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $newHomeAddress = new HomeAddress();
    $newHomeAddress->address = $request->address;
    $newHomeAddress->comuna_id = $request->comuna_id;
    $newHomeAddress->number = $request->number;
    $newHomeAddress->save();
    return response()->json([
      'respuesta' => 'Se ha creado una nueva homeAddress',
      'id' => $newHomeAddress->id
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
    $homeAddress = HomeAddress::find($id);
    if (empty($homeAddress) or $homeAddress->delete) {
      return response()->json([
        'respuesta' => 'No se ha encontrado esa homeAddress',
      ]);
    }

    return response($homeAddress, 200);
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
        'comuna_id' => 'required|exists:comunas,id',
        'number' => 'required|integer',
      ],
      [
        'name.required' => 'Debes ingresar un nombre',
        'name.min' => 'El nombre debe tener un largo minimo de 2',
        'name.max' => 'El nombre excede el numero de caracteres',
        'comuna_id.exists' => 'El ID comuna no existe',
        'number.required' => 'Debes ingresar un number',
        'number.integer' => 'El numero de casa debe ser un int',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $homeAddress = HomeAddress::find($id);
    if (empty($homeAddress) or $homeAddress->delete) {
      return response()->json([
        'respuesta' => 'No se ha encontrado esa homeAddress',
      ]);
    }

    $homeAddress->name = $request->name;
    $homeAddress->comuna_id = $request->comuna_id;
    $homeAddress->number = $request->number;
    $homeAddress->save();

    return response()->json(
      [
        'respuesta' => 'Se ha modificado la homeAddress',
        'id' => $homeAddress->id
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
    $homeAddress = HomeAddress::find($id);
    if (empty($homeAddress) or $homeAddress->delete) {
      return response("404 Not Found", 404);
    }
    $homeAddress->delete = true;
    $homeAddress->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado el homeAddress',
        'id' => $homeAddress->id
      ],
      200
    );
  }
  public function hard_destroy($id)
  {
    $homeAddress = HomeAddress::find($id);
    if (empty($homeAddress) or $homeAddress->delete) {
      return response()->json(['respuesta' => 'El id ingresado no existe']);
    }
    $homeAddress->delete();
    return response()->json([
      'respuesta' => 'El homeAddress ha sido eliminado',
      'id' => $homeAddress->id,
    ], 200);
  }
}
