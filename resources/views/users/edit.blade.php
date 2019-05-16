@extends('master')

@section('title', 'Edit user')

@section('content')

@if (count($errors) > 0)
    @include('shared.errors')
@endif

<form action="{{route('users.update', $user)}}" method="post" class="form-group">
	<!-- rotas e ver o metodo (creio que seja put mesmo) -->
    {{method_field('PUT')}}
    @include('users.partials.add-edit')
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Save</button>
        <a type="submit" class="btn btn-default" name="cancel" href="{{route('users.index')}}">Cancel</a>
        <!--falta rota index-->
    </div>
</form>
@endsection
