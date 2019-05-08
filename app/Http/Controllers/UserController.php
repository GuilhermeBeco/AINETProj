<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
     public function index()
    {
        $this->authorize('list', User::class);
        $users = User::all();
        return view('users.index', compact('users'));
    }
}
