<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SessionController extends Controller
{

  //Funcion de login
  public function login()
  {
    if (!auth()->attempt(request(['email', 'password']))) {
      return back()->withErrors([
        'message' => 'The email or password is incorrect, please try again',
      ]);
    }
    return ("A");
  }

  // //Funcion para desconectar al usuario
  // public function logout(Request $request)
  // {
  //   //Se desconecta al usuario
  //   Auth::logout();

  //   //Se invalida la sesion
  //   $request->session()->invalidate();

  //   //Se redirecciona al indice
  //   return redirect()->route('vistaIndice')->with('logout', 'Te has desconectado');
  // }
}
