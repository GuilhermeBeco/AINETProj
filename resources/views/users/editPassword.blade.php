@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Password</div>
                
                <div class="card-body">



                    <form action="{{route('editPassword')}}" method="post" class="form-group">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="inputPassword">Old Password</label>
                            <input
                                type="password" class="form-control"
                                name="old_password" id="inputPassword"/>
                        </div>
                        <div class="form-group">
                            <label for="inputNewPassword">New Password</label>
                            <input
                                type="password" class="form-control"
                                name="newPassword" id="inputNewPassword"/>
                        </div>
                        <div class="form-group">
                            <label for="inputPasswordConfirmation">Password confirmation</label>
                            <input
                                type="password" class="form-control"
                                name="newPassword_confirmation" id="inputPasswordConfirmation"/>
                        </div>
                         <div class="form-group">
                               <button type="submit" class="btn btn-success" name="ok">Add</button>
                               <a type="submit" class="btn btn-default" href="{{route('home')}}">Cancel</a>
                         </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
