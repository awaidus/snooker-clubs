@extends('layout.master')

@section('content')

    <div class="col-md-6 col-lg-offset-3">

        <h1>Logout</h1>

        {!! Form::open(['route' => 'logout']) !!}
        <button type="submit" class="btn btn-warning">
            <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
        </button>
        {!! Form::close() !!}

        <h1>Change Password</h1>

        <div class="form-horizontal">

            {!! Form::open(['route' => 'storeResetPassword']) !!}

            {{Form::formPassword('Old Password', 'old_password', null, [ 'required'])}}
            {{Form::formPassword('New Password', 'password', null, ['required'])}}
            {{Form::formPassword('Confirm New Password', 'password_confirmation', null, ['required'])}}

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>

            </div>

            {!! Form::close() !!}

        </div>

    </div>




@endsection




