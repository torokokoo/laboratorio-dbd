<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRole;
use Illuminate\Support\Facades\Validator;

class UserRoleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $userrole = UserRole::where('delete', false)->get();
    if ($userrole->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentra un rol de usuario'
      ]);
    }
    return response($userrole, 200);
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
        'role_id' => 'required|exists:roles,id',

      ],

    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $newUserRole = new UserRole();
    $newUserRole->user_id = $request->user_id;
    $newUserRole->role_id = $request->role_id;
    $newUserRole->save();
    return response()->json([
      'respuesta' => 'Se ha creado un rol de usuario',
      'id' => $newUserRole->id
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
    $userrole = UserRole::find($id);
    if (empty($userrole) or $userrole->delete) {
      return response()->json([
        'respuesta' => 'No se ha encontrado un rol de usuario',
      ]);
    }

    return response($userrole, 200);
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
        'role_id' => 'required|exists:roles,id'
      ],
      [
        'user_id.exists' => 'El ID usuario no existe',
        'role_id.exists' => 'El ID rol no existe',

      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $userRole = UserRole::find($id);
    if (empty($userRole) or $userRole->delete) {
      return response("404 Not Found", 404);
    }

    $userRole->user_id = $request->user_id;
    $userRole->role_id = $request->role_id;
    $userRole->save();
    return response()->json(
      [
        'respuesta' => 'Se ha modificado  el usuario rol',
        'id' => $userRole->id
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
    $userrole = Userrole::find($id);
    if (empty($userrole) or $userrole->delete) {
      return response("404 Not Found", 404);
    }
    $userrole->delete = true;
    $userrole->save();
    return response()->json(
      [
        'respuesta' => 'Se ha borrado el rol de usuario',
        'id' => $userrole->id
      ],
      200
    );
  }
}
