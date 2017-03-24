@extends('layout.master')

@section('content')

    <div class="col-md-6 col-lg-offset-3">

        <h1>Club Information</h1>

        @include('error._list')

        {!! Form::model($club, ['route' => 'storeBill']) !!}

        {{Form::hidden('id')}}

        <div class="form-horizontal">
            <div class="form-group">
                {{ Form::label('club_name', 'Club Name', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::text('club_name', null, ['class' => "form-control"]) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('manager_id', 'Manager', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::select('manager_id', $users, null, ['class' => "form-control"]) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('club_address', 'Address', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::text('club_address', null, ['class' => "form-control"]) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('no_of_tables', 'No of Tables', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::text('no_of_tables', null, ['class' => "form-control"]) }}
                </div>
            </div>


            <div class="form-group">

                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ route('home') }}" class="btn btn-default">Home</a>
                    @if($club->id)
                        <a href="{{ route('showGames', ['club_id'=> $club->id] ) }}" class="btn btn-primary">
                            Game Hall</a>
                    @endif
                </div>

            </div>


        </div>


    </div>


    {!! Form::close() !!}

@endsection




