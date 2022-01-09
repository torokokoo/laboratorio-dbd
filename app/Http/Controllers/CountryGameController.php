<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryGame;
use Illuminate\Support\Facades\Validator;

class CountryGameController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $countryGames = CountryGame::all();
    if ($countryGames->isEmpty()) {
      return response()->json([
        'respuesta' => 'No hay relaciones country-game'
      ]);
    }
    return response($countryGames, 200);
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
        'country_id' => 'required|exists:countries,id',
        'game_id' => 'required|exists:games,id'
      ],
      [
        'country_id.required' => 'Debes ingresar un id de country',
        'country_id.integer' => 'El id de country debe ser un entero',
        'game_id.required' => 'Debes ingresar un id de game',
        'game_id.integer' => 'El id de game debe ser un entero',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $newCountryGame = new CountryGame();
    $newCountryGame->country_id = $request->country_id;
    $newCountryGame->game_id = $request->game_id;
    $newCountryGame->save();
    return response()->json([
      'respuesta' => 'Se ha creado una nueva relacion country-game',
      'id' => $newCountryGame->id
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
    $countryGame = CountryGame::where('delete', false)->get();;
    if (empty($countryGame) or $countryGame->delete) {
      return response()->json([
        'respuesta' => 'No se ha encontrado esa relacion country-game',
      ]);
    }

    return response($countryGame, 200);
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
        'country_id' => 'required|exists:countries,id',
        'game_id' => 'required|exists:games,id'
      ],
      [
        'country_id.required' => 'Debes ingresar un id de country',
        'country_id.exists' => 'El ID del pais no existe',
        'game_id.required' => 'Debes ingresar un id de game',
        'game_id.exists' => 'El ID de game no existe',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $countryGame = CountryGame::find($id);
    if (empty($countryGame) or $countryGame->delete) {
      return response()->json([
        'respuesta' => 'No se ha encontrado esa relacion country-game',
      ]);
    }

    $countryGame->country_id = $request->country_id;
    $countryGame->game_id = $request->game_id;
    $countryGame->save();

    return response()->json(
      [
        'respuesta' => 'Se ha modificado la relacion country-game',
        'id' => $countryGame->id
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
    $countryGame = CountryGame::find($id);
    if (empty($countryGame) or $countryGame->delete) {
      return response("404 Not Found", 404);
    }
    $countryGame->delete = true;
    $countryGame->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado la country-game',
        'id' => $countryGame->id
      ],
      200
    );
  }

  public function hard_destroy($id)
  {
    $country = CountryGame::find($id);
    if (empty($countryGame) or $countryGame->delete) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $country->delete();
    return response()->json([
      'respuesta' => 'La country-game ha sido eliminada',
      'id' => $country->id,
    ], 200);
  }
}
