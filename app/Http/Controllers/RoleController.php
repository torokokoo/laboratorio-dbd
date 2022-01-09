<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $roles = Role::where('delete', false)->get();
    if ($roles->isEmpty()) {
      return response()->json([
        'respuesta' => 'No se encuentra un rol'
      ]);
    }
    return response($roles, 200);
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
        'name.required' => 'Debes ingresar un rol',
        'name.min' => 'El rol debe tener un largo minimo de 2',
        'name.max' => 'El rol excede el numero de caracteres',
      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $newRole = new Role();
    $newRole->name = $request->name;
    $newRole->save();
    return response()->json([
      'respuesta' => 'Se ha creado un nuevo rol',
      'id' => $newRole->id
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
    $role = Role::find($id);
    if (empty($role)) {
      return response()->json([
        'respuesta' => 'No se ha encontrado un rol',
      ]);
    }

    return response($role, 200);
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
        'name' => 'required|min:2|max:100'
      ],
      [

        'name.required' => 'Debes ingresar un genero',
        'name.min' => 'El genero debe tener un largo minimo de 2',
        'name.max' => 'El genero excede el numero de caracteres',
      ]
    );
    if ($validator->fails()) {
      return response($validator->errors());
    }
    $role = Role::find($id);
    if (empty($role) or $role->delete) {
      return response("404 Not Found", 404);
    }

    $role->name = $request->name;
    $role->save();
    return response()->json(
      [
        'respuesta' => 'Se ha modificado el rol',
        'id' => $role->id
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
    $role = Role::find($id);
    if (empty($role) or $role->delete) {
      return response("404 Not Found", 404);
    }
    $role->delete = true;
    $role->save();
    return response()->json(
      [
        'respuesta' => 'Se ha borrado el rol',
        'id' => $role->id
      ],
      200
    );
  }
}
