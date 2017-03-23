@extends('layout.master')

@section('content')

    <div class="col-md-6 col-lg-offset-3">

        <h1>Login</h1>

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

            @if(Session::has('flash_message'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p>{{ Session::get('flash_message') }}</p>
                </div>
            @endif

        </div>


        {!! Form::open(['route' => 'login']) !!}

        <div class="form-group">
            <div class="input-group input-group-lg">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                {{ Form::text('username', null, ['class' => "form-control", 'placeholder' => 'Username', 'required']) }}
            </div>
        </div>

        <div class="form-group">
            <div class="input-group input-group-lg">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                {{ Form::input('password', 'password', null, ['class' => "form-control", 'placeholder' => 'Password', 'required']) }}
            </div>
        </div>

        <button type="submit" class="btn btn-success btn-block">Login</button>

    </div>


    {!! Form::close() !!}

@endsection




