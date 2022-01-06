<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();
        if ($regions->isEmpty()) {
        return response()->json([
            'respuesta' => 'No hay regions'
        ]);
        }
        return response($regions, 200);
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
                'country_id' => 'required|integer'
            ],
            [
                'name.required' => 'Debes ingresar un nombre',
                'name.min' => 'El nombre debe tener un largo minimo de 2',
                'name.max' => 'El nombre excede el numero de caracteres',
                'country_id.required' => 'Debes ingresar un id de la country correspondiente',
                'country_id.integer' => 'country_id debe ser un entero',
            ]
        );
        
        if ($validator->fails()) {
            return response($validator->errors());
        }

        $newRegion = new Region();
        $newRegion->name = $request->name;
        $newRegion->country_id = $request->country_id;
        $newRegion->save();
        return response()->json([
            'respuesta' => 'Se ha creado una nueva region',
            'id' => $newRegion->id
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
        $region = Region::find($id);
        if (empty($region)) {
            return response()->json([
                'respuesta' => 'No se ha encontrado esa region',
            ]);
        }

        return response($region, 200);
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
                'country_id' => 'required|integer'
            ],
            [
                'name.required' => 'Debes ingresar un nombre',
                'name.min' => 'El nombre debe tener un largo minimo de 2',
                'name.max' => 'El nombre excede el numero de caracteres',
                'country_id.required' => 'Debes ingresar un id de la country correspondiente',
                'country_id.integer' => 'country_id debe ser un entero',
            ]
        );

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $region = Region::find($id);
        if (empty($region)) {
            return response()->json([
                'respuesta' => 'No se ha encontrado esa region',
            ]);
        }

        $region->name = $request->name;
        $region->country_id = $request->country_id;
        $region->save();

        return response()->json(
            [
                'respuesta' => 'Se ha modificado la region',
                'id' => $region->id
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
