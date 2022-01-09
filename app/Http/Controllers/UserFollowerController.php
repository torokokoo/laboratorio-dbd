<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserFollower;
use Illuminate\Support\Facades\Validator;

class UserFollowerController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $userFollowers = UserFollower::all();
    if ($userFollowers->isEmpty()) {
      return response()->json([
        'respuesta' => 'No hay nada en la relacion user-follower'
      ]);
    }
    return response($userFollowers, 200);
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
        'user_id_1' => 'required|integer',
        'user_id_2' => 'required|integer',
      ],
      [
        'user_id_1.required' => 'Debes ingresar un id1',
        'user_id_1.integer' => 'Debes ingresar un id1 valido',
        'user_id_2.required' => 'Debes ingresar un id2',
        'user_id_2.integer' => 'Debes ingresar un id2 valido',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $newUserFollower = new UserFollower();
    $newUserFollower->user_id_1 = $request->user_id_1;
    $newUserFollower->user_id_2 = $request->user_id_2;
    $newUserFollower->save();
    return response()->json([
      'respuesta' => 'Se ha creado una nueva relacion user-follower',
      'id' => $newUserFollower->id
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
    $userFollower = UserFollower::find($id);
    if (empty($userFollower)) {
      return response()->json([
        'respuesta' => 'No se ha encontrado esa relacion user-follower',
      ]);
    }

    return response($userFollower, 200);
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
        'user_id_1' => 'required|integer',
        'user_id_2' => 'required|integer',
      ],
      [
        'user_id_1.required' => 'Debes ingresar un id1',
        'user_id_1.integer' => 'Debes ingresar un id1 valido',
        'user_id_2.required' => 'Debes ingresar un id2',
        'user_id_2.integer' => 'Debes ingresar un id2 valido',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $userFollower = UserFollower::find($id);
    if (empty($userFollower)) {
      return response()->json([
        'respuesta' => 'No se ha encontrado esa relacion user-follower',
      ]);
    }

    $userFollower->user_id_1 = $request->user_id_1;
    $userFollower->user_id_2 = $request->user_id_2;
    $userFollower->save();

    return response()->json(
      [
        'respuesta' => 'Se ha modificado la relacion user-follower',
        'id' => $userFollower->id
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
    $userFollower = UserFollower::find($id);
        if (empty($userFollower) or $userFollower->delete == true) {
          return response("404 Not Found", 404);
        }
        $userFollower->delete = true;
        $userFollower->save();
        return response()->json(
          [
            'respuesta' => 'Se borrado el usuario-seguidor',
            'id' => $userFollower->id
          ],
          200
       + );
      }
  public function hard_destroy($id)
  {
    $userFollower = UserFollower::find($id);
      if (empty($userFollower)) {
        return response()->json(['respuesta' => 'El id ingresado no existe']);
      }
    $userFollower->delete();
    return response()->json([
      'respuesta' => 'El usuario-seguidor ha sido eliminado',
      'id' => $userFollower->id,
    ], 200);
  }
}
