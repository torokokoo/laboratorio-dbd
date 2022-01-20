<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Library;
use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $Transactions = Transaction::where('delete', false)->get();
    if ($Transactions->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentra '
      ]);
    }
    return response($Transactions, 200);
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
        'date' => 'required',
        'game_id' => 'required|exists:games,id',
      ],
      [
        'user_id.exists' => 'El ID usuario no existe',
        'date.required' => 'La date es obligatoria',
        'gamer_id.exists' => 'El ID juego no existe',

      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $newTransaction = new Transaction();
    $newTransaction->user_id = $request->user_id;
    $newTransaction->date = $request->date;
    $newTransaction->game_id = $request->game_id;
    $newTransaction->save();
    return response()->json([
      'respuesta' => 'Se ha creado una nueva transaccion',
      'id' => $newTransaction->id
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
    $Transaction = Transaction::find($id);
    if (empty($Transaction) or $Transaction->delete) {
      return response()->json([]);
    }
    return response($Transaction, 200);
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
        'date' => 'required',
        'game_id' => 'required|exists:games,id',
      ],
      [
        'user_id.exists' => 'El ID usuario no existe',
        'date.required' => 'La date es obligatoria',
        'gamer_id.exists' => 'El ID juego no existe',
      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $transaction = Transaction::find($id);
    if (empty($transaction) or $transaction->delete) {
      return response("404 Not Found", 404);
    }

    $transaction->user_id = $request->user_id;
    $transaction->date = $request->date;
    $transaction->game_id = $request->game_id;
    $transaction->save();
    return response()->json(
      [
        'respuesta' => 'Se ha modificado  la transaccion',
        'id' => $transaction->id
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
    $transaction = Transaction::find($id);
    if (empty($transaction) or $transaction->delete) {
      return response("404 Not Found", 404);
    }
    $transaction->delete = true;
    $transaction->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado la transaccion',
        'id' => $transaction->id
      ],
      200
    );
  }
  public function hard_destroy($id)
  {
    $transaction = Transaction::find($id);
    if (empty($transaction) or $transaction->delete) {
      return response()->json(['mensaje' => 'El id ingresado no existe']);
    }
    $transaction->delete();
    return response()->json([
      'mensaje' => 'La transaccion ha sido eliminada',
      'id' => $transaction->id,
    ], 200);
  }

  public function buyGame($id) {
    ## Se crea una nueva transaccion
    $game_id = $id;
    $user_id = $_COOKIE['id'];

    $validator = Validator::make(
      compact('game_id', 'user_id'),
      [
        'user_id' => 'required|exists:users,id',
        'game_id' => 'required|exists:games,id',
      ],
      [
        'user_id.exists' => 'El ID usuario no existe',
        'gamer_id.exists' => 'El ID juego no existe',

      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }

    $newTransaction = new Transaction();
    $newTransaction->user_id = $user_id;
    $newTransaction->date = date('Y-m-d');
    $newTransaction->game_id = $game_id;
    $newTransaction->save();

    $newLibrary = new Library();
    $newLibrary->user_id = $user_id;
    $newLibrary->game_id = $game_id;
    $newLibrary->save();

    $game = Game::find($id);
    $game->soldUnits += 1;
    $game->save();

    return redirect(sprintf('/library/%s', $_COOKIE['id']));
  }

  public function summary($id) {
    $game = Game::find($id);
    $user = User::find($_COOKIE['id']);
    if (empty($user)) {
      return redirect('/');
    }

    return view('summary', compact(['game', 'user']));
  }
}
