<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
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
        'email' => 'required|email|max:50',
        'password' => 'required|min:8',
        'birthday' => 'required|date',
        'country_id' => 'required',
        //'home_address_id' => 'required|exists:home_addresses,id',
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
        //'home_address_id.exists' => 'El ID home address no existe',
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
    $newUser->country_id = $request->country_id;
    $newUser->save();
    return redirect()->to('/login');
  }
}
