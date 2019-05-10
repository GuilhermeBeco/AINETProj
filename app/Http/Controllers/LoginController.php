<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $email =  $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password, 'ativo' => 1])) {
        	return redirect()->route('login');
		}
		return redirect()->route('welcome');
    }

}