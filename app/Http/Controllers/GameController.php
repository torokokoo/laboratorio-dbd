<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\AgeRestriction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $name = $request->get('buscarpor');
    $minprice = $request->get('buscarporminp');
    $maxprice = $request->get('buscarpormaxp');    
    //$age_restrictions = AgeRestriction::where('delete', false)->get(); // No se logro que funcionara u.u
    $games = Game::where('delete', false)->get();
    if($request){
      if ($minprice and $maxprice) {
        $games = Game::where('price', '>', "$minprice")->where('price', '<', "$maxprice")->where('delete', false)->get();
        return view('welcome', ['games' => $games, 'buscarporminp' => $minprice, 'buscarpormaxp' => $maxprice], compact('games'));
      }
      if($name){
        $games = Game::where('name', 'like', "%$name%")->where('delete', false)->get();
        return view('welcome',['games' => $games, 'buscarpor' => $name], compact('games'));
      }
    }
    if ($games->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentran juegos'
      ]);
    }
    return view('welcome',compact('games'));
  }
  public function indexC()
  {
    $games = Game::where('delete', false)->get();
    if ($games->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentran juegos'
      ]);
    }
    return
      response($games, 200);
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('subirJuego');
  }

  public function topSales()
  {
    $games = Game::all()->sortByDesc('soldUnits');
    return view('ranking', compact('games'));
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
        'name' => 'required|min:2|max:50',
        'description' => 'required|min:2|max:1000',
        'price' => 'required|min:2|max:1000',
        'storage' => 'required',
        'image' => 'required',
        'video' => 'required',
        'age_restriction_id' => 'required|exists:age_restrictions,id',
        'url_id' => 'required|exists:urls,id',
        'demo_id' => 'required|exists:demos,id'

      ],
      [
        'name.required' => 'Debes ingresar un nombre',
        'name.min' => 'El nombre debe tener un largo minimo de 2 caracteres',
        'name.max' => 'El nombre excede el numero de caracteres',
        'description.required' => 'Debes ingresar una descripcion',
        'description.min' => 'La descripcion debe tener un largo minimo de 2 caracteres',
        'description.max' => 'La descripcion excede el maximo de caracteres',
        'price.required' => 'Debes ingresar un precio',
        'storage.required' => 'Debes ingresar un almacenamiento requerido',
        'image.required' => 'Debes ingresar un link de una imagen',
        'video.required' => 'Debes ingresar un link de un video',
        'age_restriction_id.required' => 'El ID de la restriccion de edad no existe',
        'url_id.required' => 'El ID del URL no es valido',
        'demo_id.required' => 'El ID de la demo no es valido',
      ]
    );

    if ($validator->fails()) {
      return $validator->validate();
    }

    $newGame = new Game();
    $newGame->name = $request->name;
    $newGame->description = $request->description;
    $newGame->price = $request->price;
    $newGame->storage = $request->storage;
    $newGame->image = $request->image;
    $newGame->video = $request->video;
    $newGame->age_restriction_id = $request->age_restriction_id;
    $newGame->url_id = $request->url_id;
    $newGame->demo_id = $request->demo_id;
    $newGame->save();
    /*return response()->json([
      'respuesta' => 'Se ha creado un nuevo juego',
      'id' => $newGame->id
    ], 201); */
    return redirect()->to('/');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $game = Game::find($id);
    if (empty($game) or $game->delete) {
      return response("404 Not Found", 404);
    }

    $age_restriction = AgeRestriction::find($game->age_restriction_id);
    if (isset($_COOKIE['id'])){
      $user = User::find($_COOKIE['id']);
      $today = date('Y-m-d');
      $diff = date_diff(date_create($user->birthday), date_create($today));
      $age = $diff->format('%y');

      if ($age < $age_restriction->age_restriction && $_COOKIE['role'] == 'Client'){
        return view('game', compact('game'))->with('video', false);
      }
    }

    return view('game', compact('game'))->with('video', true);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Game $game)
  {
    return view('editGame', compact('game'));
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
        'name' => 'required|min:2|max:50',
        'description' => 'required|min:2|max:1000',
        'price' => 'required',
        'storage' => 'required',
        'image' => 'required',
        'video' => 'required',
        'age_restriction_id' => 'required|exists:age_restrictions,id',
        'url_id' => 'required|exists:urls,id',
        'demo_id' => 'required|exists:demos,id'

      ],
      [
        'name.required' => 'Debes ingresar un nombre',
        'name.min' => 'El nombre debe tener un largo minimo de 2 caracteres',
        'name.max' => 'El nombre excede el numero de caracteres',
        'description.required' => 'Debes ingresar una descripcion',
        'description.min' => 'La descripcion debe tener un largo minimo de 2 caracteres',
        'description.max' => 'La descripcion excede el maximo de caracteres',
        'price.required' => 'Debes ingresar un precio',
        'storage.required' => 'Debes ingresar un almacenamiento requerido',
        'image.required' => 'Debes ingresar un link de una imagen',
        'video.required' => 'Debes ingresar un link de un video',
        'age_restriction_id.required' => 'El ID de la restriccion de edad no existe',
        'url_id.required' => 'El ID del URL no es valido',
        'demo_id.required' => 'El ID de la demo no es valido',
      ]
    );
    if ($validator->fails()) {
      return $validator->validate();
    }
    $game = Game::find($id);
    if (empty($game) or $game->delete) {
      return response("404 Not Found", 404);
    }
    $game->name = $request->name;
    $game->description = $request->description;
    $game->price = $request->price;
    $game->storage = $request->storage;
    $game->image = $request->image;
    $game->video = $request->video;
    $game->age_restriction_id = $request->age_restriction_id;
    $game->url_id = $request->url_id;
    $game->demo_id = $request->demo_id;
    $game->save();
    return redirect()->to('/');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $game = Game::find($id);
    if (empty($game) or $game->delete) {
      return response("404 Not Found", 404);
    }
    $game->delete = true;
    $game->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado el juego',
        'id' => $game->id
      ],
      200
    );
  }
  public function hard_destroy($id)
  {
    $game = Game::find($id);
    if (empty($game) or $game->delete) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $game->delete();
    return response()->json([
      'mensaje' => 'El juego ha sido eliminado',
      'id' => $game->id,
    ], 200);
  }
}
