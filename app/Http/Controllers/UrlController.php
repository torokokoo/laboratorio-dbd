<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $urls = Url::all();
        if ($urls->isEmpty()) {
            return response()->json([
            'respuesta' => 'No se encuentra un url'
            ]);
        }
        return response($urls, 200);
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
              'address' => 'required|min:2|max:100',
            ],
            [
              'address.required' => 'Debes ingresar una dirección',
              'address.min' => 'La dirección debe tener un largo minimo de 2',
              'address.max' => 'La dirección excede el numero de caracteres',
            ]
          );
          if ($validator->fails()) {
            return response($validator->errors());
          }
          $newUrl = new Url();
          $newUrl->address= $request->address;
          $newUrl->save();
          return response()->json([
            'respuesta' => 'Se ha creado un nuevo url',
            'id' => $newUrl->id
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
        //
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
          'address' => 'required|min:2|max:100'
        ],
        [
  
          'address.required' => 'Debes ingresar un genero',
          'address.min' => 'La dirección debe tener un largo minimo de 2',
          'address.max' => 'La dirección excede el numero de caracteres',
        ]
      );
      if ($validator->fails()) {
        return response($validator->errors());
      }
      $url = Url::find($id);
      if (empty($url) or $url->delete == true) {
        return response("404 Not Found", 404);
      }
  
      $url->address = $request->address;
      $url->save();
      return response()->json(
        [
          'respuesta' => 'Se ha modificado el url',
          'id' => $->$url->id
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
        $url = Url::find($id);
        if (empty($url) or $url->delete == true) {
          return response("404 Not Found", 404);
        }
        $url->delete = true;
        $url->save();
        return response()->json(
          [
            'respuesta' => 'Se ha  borrado el url',
            'id' => $url->id
          ],
          200
        );
    }
}
