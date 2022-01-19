<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;

class SessionController
{
  public function view()
  {
    return view('login');
  }
  // Se logea al usuario
  public function login(Request $request)
  {
    $user = User::where('email', $request->email,)->first();
    $validator = Validator::make(
      $request->all(),
      [
        'email' => 'required|email|max:50|exists:users,email',
        'password' => 'required|exists:users,password'
      ],
      [
        'email.exists' => 'Usuario/Contraseña incorrecta',
        'email.required' => 'Debe ingresar email',
        'password.exists' => 'Usuario/Contraseña incorrecta',
        'password.required' => 'Debe ingresar contraseña',
      ]
    );
    if ($validator->fails()) {
      return $validator->validate();
    }
    try {
      if ($user->password == $request->password) {
        $id = $user->id;
        $rol = Role::find($user->role_id);
        setcookie("role", $rol->name);
        setcookie("id", $id);
        setcookie("user", $user->name);
        return redirect()->to('/');
      } else {
        return "Contraseña no existe";
      }
    } catch (Exception $e) {
      return redirect()->to('/login');
    }
  }
  // Se deslogea al usuario
  public function logout()
  {
    // unset($_COOKIE['id']);
    // unset($_COOKIE['username']);
    setcookie("id", "", time() - 3600);
    setcookie("user", "", time() - 3600);
    setcookie("role", "", time() - 3600);
    return redirect()->to('/login');
  }
}
