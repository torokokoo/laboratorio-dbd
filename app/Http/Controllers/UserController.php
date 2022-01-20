<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserFollower;
use Exception;
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
    return view('users', compact('users'));
  }
  public function indexCrud()
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
      return $validator->validate();
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

    try {
      $user = User::find($id);
      $a = [];
      $followers = UserFollower::where('user2_id', $user->id)->orwhere('user1_id', $user->id)->get();
      foreach ($followers as $fol) {
        array_push($a, $fol->id);
      }
      $users = User::whereIn('id', $a)->get();
      $size = count($users);

      $curr = Currency::find($user->currency_id);
      $role = Role::find($user->role_id);
      $count = Country::find($user->country_id);
      $rol = $role->name;
      $cur = $curr->name;
      $country = $count->name;
      return view('userProfile', compact('user', 'country', 'rol', 'cur', 'users', 'size'));
    } catch (Exception $e) {
      return 404;
    }
  }
  public function followers(User $user)
  {

    return view('followers', compact('user',));
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
    $countries = Country::All();
    $currencies = Currency::All();
    return view('editUser', compact('user', 'countries', 'currencies'));
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
        'email' => 'required|email|max:50|unique:users',
        'password' => 'required|min:8',
        'birthday' => 'required|date',
        'country_id' => 'required',
        'currency_id' => 'required',
      ],
      [
        'name.required' => 'Debes ingresar un nombre',
        'name.min' => 'El nombre debe tener un largo minimo de 2 caracteres',
        'name.max' => 'El nombre excede el numero de caracteres',
        'email.required' => 'Debes ingresar un email',
        'email.email' => 'Debes ingresar un email valido',
        'email.max' => 'El email excede el numero de caracteres',
        'email.unique' => 'El email ya esta registrado',
        'password.required' => 'Debes ingresar una password',
        'password.min' => 'La password debe tener un largo minimo de 8',
        'birthday.required' => 'Debes ingresar una fecha de nacimiento',
        'birthday.date' => 'La fecha tiene que ser valida',
        'country_id.required' => 'Debe ingresar un pais',
        'currency_id.required' => 'Debe ingresar una moneda',

      ]
    );
    if ($validator->fails()) {
      return $validator->validate();
    }

    $user = User::find($id);
    if (empty($user) or $user->delete) {
      return response("404 Not Found", 404);
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->birthday = $request->birthday;
    $user->country_id = $request->country_id;
    $user->currency_id = $request->currency_id;
    $user->save();
    return redirect()->to('/users');
    //return redirect()->route('/', $user);
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
