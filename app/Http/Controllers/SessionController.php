<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SessionController extends Controller
{
  public function view()
  {
    return view('login');
  }

  public function login(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'email' => 'required|email|max:50',
        'password' => 'required|min:8'
      ],
      [
        'email.required' => 'Debes ingresar un email',
        'email.email' => 'Debes ingresar un email valido',
        'email.max' => 'El email excede el numero de caracteres',
        'password.required' => 'Debes ingresar una password',
        'password.min' => 'La password debe tener un largo minimo de 8',
      ]
    );

    if ($validator->fails()) {
      return $validator->validate();
    }
    $credentias = request()->only('email', 'password');
    if (Auth::attempt($credentias)) {
      return $validator->validate();
    }
    return $validator->validate();
  }
}
