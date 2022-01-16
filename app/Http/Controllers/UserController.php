<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = User::where('delete', false)->get();
    if ($users->isEmpty()) {
      return response()->json([
        'respuesta' => 'No hay users'
      ]);
    }
    return response($users, 200);
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
        'name' => 'required|min:2|max:50',
        'email' => 'required|email|max:50',
        'password' => 'required|min:8',
        'birthday' => 'required|date',
        'home_address_id' => 'required|exists:home_addresses,id',
        'currency_id' => 'required|exists:currencies,id'
      ],
      [
        'name.required' => 'Debes ingresar un nombre',
        'name.min' => 'El nombre debe tener un largo minimo de 2',
        'name.max' => 'El nombre excede el numero de caracteres',
        'email.required' => 'Debes ingresar un email',
        'email.email' => 'Debes ingresar un email valido',
        'email.max' => 'El email excede el numero de caracteres',
        'password.required' => 'Debes ingresar una password',
        'password.min' => 'La password debe tener un largo minimo de 8',
        'birthday.required' => 'Debes ingresar una fecha de nacimiento',
        'birthday.date' => 'La fecha tiene que ser valida',
        'home_address_id.exists' => 'El ID home address no existe',
        'currency_id.exists' => 'El ID de la moneda no existe',
      ]
    );

    if ($validator->fails()) {
      return response($validator->errors());
    }

    $newUser = new User();
    $newUser->name = $request->name;
    $newUser->email = $request->email;
    $newUser->password = $request->password;
    $newUser->birthday = $request->birthday;
    $newUser->balance = 0;
    $newUser->home_address_id = $request->home_address_id;
    $newUser->save();
    return response()->json([
      'respuesta' => 'Se ha creado una nueva user',
      'id' => $newUser->id
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
    $user = User::find($id);
    if (empty($user) or $user->delete) {
      return response()->json([
        'respuesta' => 'No se ha encontrado ese user',
      ]);
    }

    return response($user, 200);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function editAdmin(User $user)
  {
    return view('editUserAdmin', compact('user'));
  }
  public function edit(User $user)
  {
    return view('editUser', compact('user'));
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
        'name' => 'required|min:2|max:50',
        'email' => 'required|email|max:50',
        'password' => 'required|min:8',
        'birthday' => 'required|date',
        'home_address_id' => 'required|exists:home_addresses,id',
        'balance' => 'required',
        'currency_id' => 'required|exists:currencies,id'
      ],
      [
        'name.required' => 'Debes ingresar un nombre',
        'name.min' => 'El nombre debe tener un largo minimo de 2 caracteres',
        'name.max' => 'El nombre excede el numero de caracteres',
        'email.required' => 'Debes ingresar un email',
        'email.email' => 'Debes ingresar un email valido',
        'email.max' => 'El email excede el numero de caracteres',
        'password.required' => 'Debes ingresar una password',
        'password.min' => 'La password debe tener un largo minimo de 8',
        'birthday.required' => 'Debes ingresar una fecha de nacimiento',
        'birthday.date' => 'La fecha tiene que ser valida',
        'home_address_id.exists' => 'El ID home address no existe',
        'balance' => 'Debe ingresar una cantidad',
        'currency_id.exists' => 'El ID de la moneda no existe',

      ]
    );

    if ($validator->fails()) {
      return $validator->validate();
    }

    $user = User::find($id);
    if (empty($user) or $user->delete) {
      return response()->json([
        'respuesta' => 'No se ha encontrado ese user',
      ]);
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->birthday = $request->birthday;
    $user->balance = 0;
    $user->home_address_id = $request->home_address_id;
    $user->save();
    return redirect()->route('/', $user);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $user = User::find($id);
    if (empty($user) or $user->delete) {
      return response("404 Not Found", 404);
    }
    $user->delete = true;
    $user->save();
    return response()->json(
      [
        'respuesta' => 'Se borrado el usuario',
        'id' => $user->id
      ],
      200
    );
  }
  public function hard_destroy($id)
  {
    $user = User::find($id);
    if (empty($user) or $user->delete) {
      return response()->json(['respuesta' => 'El id ingresado no existe']);
    }
    $user->delete();
    return response()->json([
      'respuesta' => 'El usuario ha sido eliminado',
      'id' => $user->id,
    ], 200);
  }
}
