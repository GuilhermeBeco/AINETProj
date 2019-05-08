<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
     public function index()
    {
        $this->authorize('list', User::class);
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function showEditPassword(){
    	return view('users.editPassword');
    }
    public function editPassword(Request $request){
    	$user = Auth::user();

        $password = $request->validate([
        	'oldPassword' => 'required',
        	'newPassword' => 'required|confirmed'
        ]);  
        if(!Hash::check($request->oldPassword, Auth::user()->password)){
        	return "Password Invalida";
        }          
        dd($user, $request->oldPassword, $password);
    }
}
