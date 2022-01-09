<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {

    $currencies = Currency::where('delete', false)->get();
    if ($currencies->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentra '
      ]);
    }
    return response($currencies, 200);
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
        'USdollarExchange' => 'required'
      ],
      [
        'name.required' => 'Debes ingresar una moneda',
        'USdollarExchange.required' => 'Debes ingresar un tipo de cambio',
        'name.min' => 'La moneda debe tener un largo minimo de 2',
        'name.max' => 'La moneda excede el numero de caracteres',
      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $newCurrency = new Currency();
    $newCurrency->name = $request->name;
    $newCurrency->USdollarExchange = $request->USdollarExchange;
    $newCurrency->save();
    return response()->json([
      'respuesta' => 'Se ha creado una nueva moneda',
      'id' => $newCurrency->id
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
    $currency = Currency::find($id);
    if (empty($currency) or $currency->delete) {
      return response("404 Not Found", 404);
    }
    return response($currency, 200);
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
        'USdollarExchange' => 'required'
      ],
      [
        'name.required' => 'Debes ingresar una moneda',
        'USdollarExchange.required' => 'Debes ingresar un tipo de cambio',
        'name.min' => 'La moneda debe tener un largo minimo de 2',
        'name.max' => 'La moneda excede el numero de caracteres',
      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $currency = Currency::find($id);
    if (empty($currency) or $currency->delete) {
      return response("404 Not Found", 404);
    }

    $currency->name = $request->name;
    $currency->USdollarExchange = $request->USdollarExchange;
    $currency->save();
    return response()->json(
      [
        'respuesta' => 'Se ha modificado la moneda',
        'id' => $currency->id
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
    $currency = Currency::find($id);
    if (empty($currency) or $currency->delete) {
      return response("404 Not Found", 404);
    }
    $currency->delete = true;
    $currency->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado la moneda',
        'id' => $currency->id
      ],
      200
    );
  }
  public function hard_destroy($id)
  {
    $currency = Currency::find($id);
    if (empty($currency) or $currency->delete) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $currency->delete();
    return response()->json([
      'mensaje' => 'La moneda ha sido eliminada',
      'id' => $currency->id,
    ], 200);
  }
}
