@extends('layout.master')

@section('content')

    @include('layout._admin-site-menu')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        <div class="col-md-6">

            <h1>Club Information</h1>

            @include('error._list')

            {!! Form::model($club, ['route' => 'storeClub']) !!}

            {{Form::hidden('id', $club->id)}}


            <div class="form-horizontal">


                <div class="form-group">
                    {{ Form::label('club_name', 'Club Name', ['class'=> 'col-sm-3 control-label']) }}
                    <div class="col-sm-9">
                        {{ Form::text('club_name', null, ['class' => "form-control"]) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('manager_id', 'Manager', ['class'=> 'col-sm-3 control-label']) }}
                    <div class="col-sm-9">
                        {{ Form::select('manager_id', $users, null, ['class' => "form-control"]) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('club_address', 'Address', ['class'=> 'col-sm-3 control-label']) }}
                    <div class="col-sm-9">
                        {{ Form::text('club_address', null, ['class' => "form-control"]) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('no_of_tables', 'No of Tables', ['class'=> 'col-sm-3 control-label']) }}
                    <div class="col-sm-9">
                        {{ Form::text('no_of_tables', null, ['class' => "form-control"]) }}
                    </div>
                </div>


                <div class="form-group">

                    <div class="col-sm-offset-2 col-sm-9">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('home') }}" class="btn btn-default">Home</a>
                        @if($club->id)
                            <a href="{{ route('showGames', ['club_id'=> $club->id] ) }}" class="btn btn-primary">
                                Game Hall</a>
                        @endif
                    </div>

                </div>


            </div>


            {!! Form::close() !!}

        </div>

    </div>

@endsection




