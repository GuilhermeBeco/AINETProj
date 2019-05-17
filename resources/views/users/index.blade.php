@extends('master')

@section('title', 'List users')

@section('content')
@can('create', App\User::class)
<div>
    <a class="btn btn-primary" href="{{route('users.create')}}">Add user</a>
</div>
@endcan

@if(count($users))
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Nº sócio</th>
            <th>Tipo de sócio</th>
            <th>Nome Informal</th>
            <th>Email</th>
            <th>Foto</th>
            <th>Telefone</th>
            <th>Direção</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{$user->num_socio}}</td>
            <td>{{$user->typeToStr() }}</td>
            <td>{{$user->nome_informal}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->foto_url}}</td>
            <td>{{$user->telefone}}</td>
            <td>{{$user->isDirecao()}}</td>
            <td>{{$user->num_licenca}}</td>
         </tr>
                @can('update', $user)
                <a class="btn btn-xs btn-primary" href="{{route('users.edit', $user)}}">Edit</a> 
                <!-- a verificacao de direção/pilotovai ter de ser feita quando for e redirect -->
                @endcan
                
                @can('delete', $user)
                <form action="{{route('users.destroy', $user)}}" method="POST" role="form" class="inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                </form>
                @endcan
            </td>
        </tr>
    @endforeach
    </table>
@else
    <h2>No users found</h2>
@endif
@endsection
