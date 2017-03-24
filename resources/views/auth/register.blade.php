@extends('layout.master')

@section('content')

    <div class="col-md-6 col-lg-offset-3">

        <h1>Register a user</h1>

        <div class="row">
            @if($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>

        {!! Form::open(['route' => 'storeUser']) !!}

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {{ Form::text('username', null, ['class' => "form-control", 'placeholder' => 'Username', 'required']) }}
            </div>
        </div>


        <div class="form-group">

            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {{ Form::text('first_name', null, ['class' => "form-control", 'placeholder' => 'Name', 'required']) }}
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                {{ Form::email('email', null, ['class' => "form-control", 'placeholder' => 'someone@domain.com']) }}
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                {{ Form::input('password', 'password', null, ['class' => "form-control", 'placeholder' => 'Password', 'required']) }}
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                {{ Form::select('manager_id', $roles, null, ['class' => "form-control"]) }}
            </div>
        </div>


        <button type="submit" class="btn btn-success btn-block">Register</button>

    </div>


    {!! Form::close() !!}

@endsection




