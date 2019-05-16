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
        $array=array();
        if($request->has('foto')){
         $array['foto'] = 'required';
        }
        if($request->has('nome_informal')){
         $array['nome_informal'] = 'required';
        }
        if($request->has('email')){
         $array['email'] = 'required';
        }
        if($request->has('name')){
         $array['name'] = 'required';
        }
        if($request->has('data_nascimento')){
         $array['data_nascimento'] = 'required';
        }
        if($request->has('nif')){
         $array['nif'] = 'required';
        }
        if($request->has('telefone')){
         $array['telefone'] = 'required';
        }
        if($request->has('endereco')){
         $array['endereco'] = 'required';
        }
        $user->fill($request->validated($array));
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
    public function selectFilter(Request $request)
    {
         if ($request->has('num_socio')) {
            $users->where('num_socio', $request->num_socio);
        }
        if ($request->has('nome_informal')) {
            $users->where('nome_informal', $request->nome_informal);
        }
        if ($request->has('email')) {
            $users->where('email', $request->email);
        }
        if ($request->has('telefone')) {
            $users->where('telefone', $request->telefone);
        }
        if ($request->has('tipo_socio')) {
            $users->where('tipo_socio', $request->tipo_socio);
        }
        if ($request->has('num_licenca')) {
            $users->where('num_licenca', $request->num_licenca);
        }
        $users->where('ativo',1);
        $users->get();//falta os campos
        return view('users.index', compact('users'));
        //meter em orm..
    }

    public function startHome(){
        $user=Auth::user();
        //policy para a distinguir a us 6 da us 14
        $details = User::where('id' == $user->id)->paginate(15, ['num_socio', 'nome_informal', 'foto', 'email', 'telefone', 'tipo_socio', 'endereco','name','sexo','data_nascimento','nif','ativo','quotas_pagas','direcao']);
        //falta funcao de converter o tipo de socio
        return view('users.details', compact('details')); //falta rota
    }
    public function selectPlane(){
        $planes=Plane::where('num_lugares'>0)->paginate(15,['matricula','marca','modelo','num_lugares','conta_horas','preco_hora']);
        //o conta_horas e o total horas??
        return view('planes.index',compact('planes'));
        //falta vista e rotas

    }
    public function selectMove(){
        $moves=Move::where('id'>0)->paginate(15['id','aeronave.matricul','data','hora_descolagem','hora_aterragem','tempo_voo','natureza','users.nome_informal','aerodromo_partida.id','aerodromo_chegada.id','num_aterragens','num_descolagens','num_diario','num_servico','conta_horas_inicio','conta_horas_fim','num_pessoas','tipo_instrucao','intrutor.nome_informal','confirmado','observacoes']);
        return view ('moves.index',compact(('moves')));//falta vista e rotas
        //duvida-> ir buscar os dados das fk's
    }
    public function selectFilter(Request $request)
    {
         if ($request->has('id')) {
            $moves->where('id', $request->num_socio);
        }
        if ($request->has('plane')) {
            $moves->where('aeronave', $request->plane);//duvida do que é para ir buscar e como
        }
        if ($request->has('piloto')) {
            $users->where('piloto_id', $request->piloto);//como ir buscar o nome
        }
        if ($request->has('instrutor')) {
            $users->where('instrutor_id', $request->instrutor);//como ir buscar o nome
        }
        if ($request->has('natureza')) {
            $users->where('natureza', $request->natureza);
        }
        if ($request->has('confirmado')) {
            $users->where('confirmado', $request->confirmado);
        }
        if ($request->has('data_voo')) {
            $users->whereRaw('data_voo ', $request->data_voo);
        }
        //fazer o menor e o maior ??

        $users->where('ativo',1);
        $users->get();
        return view('users.index', compact('users'));
        //meter em orm..
    }
}
