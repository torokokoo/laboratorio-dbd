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

  public function login(Request $request)
  {
    $user = User::where($request->mail)->first();
    if ($user->password == $request->password) {
      setcookie("Logeado", true);
      return
        redirect()->to('/');
    }
    return redirect()->to('/login');
  }
}
