<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionCurrency;
use Illuminate\Support\Facades\Validator;

class TransactionCurrencyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $TransactionCurrencies = TransactionCurrency::all();
    if ($TransactionCurrencies->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentra '
      ]);
    }
    return response($TransactionCurrencies, 200);
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
        'transaction_id' => 'required|exists:transactions,id',
        'currency_id' => 'required|exists:currencies,id'
      ],
      [
        'transaction_id.exists' => 'El ID transaccion no existe',
        'currency_id.exists' => 'El ID moneda no existe',
      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $newTransactionCurrencies = new TransactionCurrency();
    $newTransactionCurrencies->transaction_id = $request->transaction_id;
    $newTransactionCurrencies->currency_id = $request->currency_id;
    $newTransactionCurrencies->save();
    return response()->json([
      'respuesta' => 'Se ha creado una nueva transaccion-moneda',
      'id' => $newTransactionCurrencies->id
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
    $TransactionCurrency = TransactionCurrency::find($id);
    if (empty($transactionCurrency) or $transactionCurrency->delete == true) {
      return response("404 Not Found", 404);
    }
    return response($TransactionCurrency, 200);
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
        'transaction_id' => 'required|exists:transactions,id',
        'currency_id' => 'required|exists:currencies,id'
      ],
      [
        'transaction_id.exists' => 'El ID transaccion no existe',
        'currency_id.exists' => 'El ID moneda no existe',

      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $transactionCurrency = TransactionCurrency::find($id);
    if (empty($transactionCurrency) or $transactionCurrency->delete == true) {
      return response("404 Not Found", 404);
    }

    $transactionCurrency->transaction_id = $request->transaction_id;
    $transactionCurrency->currency_id = $request->currency_id;
    $transactionCurrency->save();
    return response()->json(
      [
        'respuesta' => 'Se ha modificado  la transaccion-moneda',
        'id' => $transactionCurrency->id
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
    $transactionCurrency = TransactionCurrency::find($id);
    if (empty($transactionCurrency) or $transactionCurrency->delete == true) {
      return response("404 Not Found", 404);
    }
    $transactionCurrency->delete = true;
    $transactionCurrency->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado la transaccion',
        'id' => $transactionCurrency->id
      ],
      200
    );
  }
}
