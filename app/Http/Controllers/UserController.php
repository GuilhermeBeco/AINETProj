<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $this->authorize('create', User::class);

        $user = new User;
        return view('users.add', compact('user'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        $user = new User();
        $user->fill($request->all());
        $user->ativo = false;
        $user->password_inicial = true;
        $user->password = Hash::make($request->data_nascimento);//a pass inicial
        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User added successfully!');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();
        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully!');
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->fill($request->validated());
        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully!');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function index()
    {
        if ($this->authorize('list', User::class)) {
            $users = User::all();
        } else {
            $users = User::where('ativo' == 1)->paginate(15, ['num_socio', 'nome_informal', 'foto', 'email', 'telefone', 'tipo_socio', 'num_licenca', 'direcao']);
        }

        return view('users.index', compact('users'));
    }

    public function showEditPassword()
    {
        return view('users.editPassword');
    }

    public function editPassword(Request $request)
    {
        $user = Auth::user();

        $password = $request->validate([
            'old_password' => 'required',
            'newPassword' => 'required|confirmed'
        ]);
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return "Password Invalida";
        }
        dd($user, $request->old_password, $password);
        /*
        update($request,$user)
        */
    }
}
