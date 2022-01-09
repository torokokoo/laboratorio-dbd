<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Validator;

class RolePermissionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $rolepermissions = RolePermission::where('delete', false)->get();
    if ($rolepermissions->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentra un Permiso_Rol'
      ]);
    }
    return response($rolepermissions, 200);
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

        'permission_id' => 'required|exists:permissions,id',
        'role_id' => 'required|exists:roles,id',

      ],

    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $newRolePermission = new RolePermission();
    $newRolePermission->permission_id = $request->permission_id;
    $newRolePermission->role_id = $request->role_id;
    $newRolePermission->save();
    return response()->json([
      'respuesta' => 'Se ha creado un permiso de rol',
      'id' => $newRolePermission->id
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
    $rolepermission = RolePermission::find($id);
    if (empty($rolepermission)) {
      return response()->json([
        'respuesta' => 'No se ha encontrado un rol de permiso',
      ]);
    }

    return response($rolepermission, 200);
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
        'permission_id' => 'required|exists:permissions,id',
        'role_id' => 'required|exists:roles,id'
      ],
      [
        'permission_id.exists' => 'El ID permiso no existe',
        'role_id.exists' => 'El ID rol no existe',

      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $rolePermission = RolePermission::find($id);
    if (empty($rolePermission) or $rolePermission->delete) {
      return response("404 Not Found", 404);
    }

    $rolePermission->permission_id = $request->permission_id;
    $rolePermission->role_id = $request->role_id;
    $rolePermission->save();
    return response()->json(
      [
        'respuesta' => 'Se ha modificado  el permiso rol',
        'id' => $rolePermission->id
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
    $rolepermission = Rolepermission::find($id);
    if (empty($rolepermission) or $rolepermission->delete) {
      return response("404 Not Found", 404);
    }
    $rolepermission->delete = true;
    $rolepermission->save();
    return response()->json(
      [
        'respuesta' => 'Se ha  borrado el rol permiso',
        'id' => $rolepermission->id
      ],
      200
    );
  }
}
