<?php

namespace App\Http\Controllers;

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
                'user_id_1' => 'required|exists:users,id',
                'user_id_2' => 'required|exists:users,id',
            ],
            [
                'user_id_1.required' => 'Debes ingresar un id1',
                'user_id_1.exists' => 'Debes ingresar un id1 valido',
                'user_id_2.required' => 'Debes ingresar un id2',
                'user_id_2.exists' => 'Debes ingresar un id2 valido',
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
                'user_id_1' => 'required|exists:users,id',
                'user_id_2' => 'required|exists:users,id',
            ],
            [
                'user_id_1.required' => 'Debes ingresar un id1',
                'user_id_1.exists' => 'Debes ingresar un id1 valido',
                'user_id_2.required' => 'Debes ingresar un id2',
                'user_id_2.exists' => 'Debes ingresar un id2 valido',
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
        //
    }
}
