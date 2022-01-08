<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GameGender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameGenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gamegenders = GameGender::all();
        if ($gamegenders->isEmpty()) {
          return response()->json([
            'respuesta' => 'No se encuentra juego-genero'
          ]);
        }
        return response($gamegenders, 200);
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
                'game_id' => 'required|exists:games,id',
                'gender_id' => 'required|exists:genders,id'

            ],
            [
                'game_id.required' => 'El ID del juego no es valido',
                'gender_id.required' => 'El ID del genero no es valido',
            ]
        );
        
        if ($validator->fails()) {
            return response($validator->errors());
        }

        $newGameGender = new GameGender();
        $newGameGender->game_id = $request->game_id;
        $newGameGender->gender_id = $request->gender_id;
        $newGameGeder->save();
        return response()->json([
            'respuesta' => 'Se ha creado un nuevo juego-genero',
            'id' => $newGameGender->id
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
        $gamegender = GameGender::find($id);
        if (empty($gamegender) or $gamegender->delete == true) {
          return response("404 Not Found", 404);
        }
        return response($gamegender, 200);
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
                'game_id' => 'required|exists:games,id',
                'gender_id' => 'required|exists:genders,id'

            ],
            [
                'game_id.required' => 'El ID del juego no es valido',
                'gender_id.required' => 'El ID del genero no es valido',
            ]
        );
        
        if ($validator->fails()) {
            return response($validator->errors());
        }
        $gamegender = GameGender::find($id);
        if (empty($gamegender) or $game->delete == true) {
            return response("404 Not Found", 404);

        $gamegender->game_id = $request->game_id;
        $gamegender->gender_id = $request->gender_id;
        $gamegender->save();
        return response()->json(
            [
              'respuesta' => 'Se ha modificado el juego-genero',
              'id' => $gamegender->id
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
        $gamegender = GameGender::find($id);
        if (empty($gamegender) or $gamegender->delete == true) {
          return response("404 Not Found", 404);
        }
        $gamegender->delete = true;
        $gamegender->save();
        return response()->json(
          [
            'respuesta' => 'Se borrado el juego-genero',
            'id' => $gamegender->id
          ],
          200
        );
    }
}
