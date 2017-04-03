@extends('layout.master')

@section('content')

    <div class="col-md-6 col-lg-offset-3">

        <h1>Change Password</h1>

        <div class="form-horizontal">

            {!! Form::open(['route' => 'storeResetPassword']) !!}


            {{Form::formInput('Old Password', 'old_password', null, ['type'=>'password', 'required'])}}
            {{Form::formInput('New Password', 'password', null, ['type'=>'password', 'required'])}}
            {{Form::formInput('Confirm New Password', 'password_confirmation', null, ['type'=>'password', 'required'])}}

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>

            </div>

            {!! Form::close() !!}

        </div>

    </div>




@endsection




