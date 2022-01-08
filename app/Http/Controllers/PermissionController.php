<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $permissions = Permission::all();
        if ($permissions->isEmpty()) {
            return response()->json([
            'respuesta' => 'No existe permiso'
            ]);
        }
        return response($permissions, 200);
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
    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
              'name' => 'required|min:2|max:100',
            ],
            [
              'name.required' => 'Debes ingresar un permiso',
              'name.min' => 'El permiso debe tener un largo minimo de 2',
              'name.max' => 'El permiso excede el numero de caracteres',
            ]
          );
          if ($validator->fails()) {
            return response($validator->errors());
          }
          $newPermission = new Permission();
          $newPermission->name = $request->name;
          $newPermission->save();
          return response()->json([
            'respuesta' => 'Se ha creado un nuevo permiso',
            'id' => $newPermission->id
          ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $permission = Permission::find($id);
        if (empty($permission)) {
            return response()->json([
                'respuesta' => 'No se ha encontrado permiso',
            ]);
        }

        return response($permission, 200);
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
    public function update(Request $request, $id){
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
      $permission = Permission::find($id);
      if (empty($permission) or $permission->delete == true) {
        return response("404 Not Found", 404);
      }
  
      $permission->name = $request->name;
      $permission->save();
      return response()->json(
        [
          'respuesta' => 'Se ha modificado el permiso',
          'id' => $permission->id
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
    public function destroy($id){
        $permission = Permission::find($id);
        if (empty($permission) or $permission->delete == true) {
          return response("404 Not Found", 404);
        }
        $permission->delete = true;
        $permission->save();
        return response()->json(
          [
            'respuesta' => 'Se ha  borrado el permiso',
            'id' => $permission->id
          ],
          200
        );
    }
}
