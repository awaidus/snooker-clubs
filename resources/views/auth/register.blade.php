@extends('layout.master')

@section('content')

    <div class="col-md-6 col-lg-offset-3">

        <h1>User Information</h1>

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

        <div class="form-horizontal">

            {!! Form::model($user, ['route' => 'storeUser']) !!}

            <div class="form-group">
                {{ Form::label('username', 'Username', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::text('username', null, ['class' => "form-control"]) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::input('password', 'password', null, ['class' => "form-control"]) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('first_name', 'Name', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::text('first_name', null, ['class' => "form-control"]) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('role_id', 'Role', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::select('role_id', $roles, null, ['class' => "form-control"]) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>

            </div>

            {!! Form::close() !!}

        </div>

    </div>




@endsection




