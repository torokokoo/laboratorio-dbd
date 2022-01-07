<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comuna;
use Illuminate\Support\Facades\Validator;

class ComunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comunas = Comuna::all();
        if ($comunas->isEmpty()) {
        return response()->json([
            'respuesta' => 'No hay comunas'
        ]);
        }
        return response($comunas, 200);
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
                'region_id' => 'required|integer'
            ],
            [
                'name.required' => 'Debes ingresar un nombre',
                'name.min' => 'El nombre debe tener un largo minimo de 2',
                'name.max' => 'El nombre excede el numero de caracteres',
                'region_id.required' => 'Debes ingresar un id de la region correspondiente',
                'region_id.integer' => 'region_id debe ser un entero',
            ]
        );
        
        if ($validator->fails()) {
            return response($validator->errors());
        }

        $newComuna = new Comuna();
        $newComuna->name = $request->name;
        $newComuna->region_id = $request->region_id;
        $newComuna->save();
        return response()->json([
            'respuesta' => 'Se ha creado una nueva comuna',
            'id' => $newComuna->id
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
        $comuna = Comuna::find($id);
        if (empty($comuna)) {
            return response()->json([
                'respuesta' => 'No se ha encontrado esa comuna',
            ]);
        }

        return response($comuna, 200);
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
                'name' => 'required|min:2|max:100',
                'region_id' => 'required|integer'
            ],
            [
                'name.required' => 'Debes ingresar un nombre',
                'name.min' => 'El nombre debe tener un largo minimo de 2',
                'name.max' => 'El nombre excede el numero de caracteres',
                'region_id.required' => 'Debes ingresar un id de la region correspondiente',
                'region_id.integer' => 'region_id debe ser un entero',
            ]
        );

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $comuna = Comuna::find($id);
        if (empty($comuna)) {
            return response()->json([
                'respuesta' => 'No se ha encontrado esa comuna',
            ]);
        }

        $comuna->name = $request->name;
        $comuna->region_id = $request->region_id;
        $comuna->save();

        return response()->json(
            [
                'respuesta' => 'Se ha modificado la comuna',
                'id' => $comuna->id
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