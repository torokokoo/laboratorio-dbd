<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SessionController extends Authenticatable
{
  public function view()
  {
    return view('login');
  }
  // Se logea al usuario
  public function login(Request $request)
  {
    $user = User::where('email', $request->email,)->first();
    if ($user->password == $request->password) {
      setcookie("id", $user->id);
      setcookie("user", $user->name);
      return
        redirect()->to('/');
    }
    return redirect()->to('/login');
  }
  // Se deslogea al usuario
  public function logout()
  {
    // unset($_COOKIE['id']);
    // unset($_COOKIE['username']);
    setcookie("id", "", time() - 3600);
    setcookie("user", "", time() - 3600);
    return redirect()->to('/');
  }
}