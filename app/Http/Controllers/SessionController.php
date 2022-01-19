<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
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
    $user = User::where('email', $request->email)->first();
    if ($user->password == $request->password) {
      $id = $user->id;
      $rol = Role::find($user->role_id);
      setcookie("role", $rol->name);
      setcookie("id", $id);
      setcookie("user", $user->name);
      return redirect()->to('/');
    } else {
      return redirect()->to('/login'); // Añadir mensaje de error en vez de redireccionamiento
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
