<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
  public function view()
  {
    $countries = Country::All();
    return view('register', compact('countries'));
  }

  public function create()
  {

    return;
  }

  public function store(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'name' => 'required|min:2|max:50',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'birthday' => 'required|date',
        'country_id' => 'required',
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
        'country_id.exists' => 'Debe ingresar pais',
        'email.unique' => 'El correo ya existe'
      ]
    );

    if ($validator->fails()) {
      return $validator->validate();
    }

    $newUser = new User();
    $role = Role::where('name', 'Client')->first();
    $newUser->name = $request->name;
    $newUser->email = $request->email;
    $newUser->password = $request->password;
    $newUser->birthday = $request->birthday;
    $newUser->role_id = $role->id;
    $newUser->country_id = $request->country_id;
    $newUser->currency_id = 1;
    $newUser->save();
    return redirect()->to('/login');
  }
}
