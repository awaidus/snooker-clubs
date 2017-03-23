@extends('layout.master')

@section('content')


    <div class="col-md-6 col-lg-offset-3">

        <h1>Game Information</h1>

        @include('error._list')

        {!! Form::model($game, ['route' => 'storeGame']) !!}

        {{Form::hidden('id')}}
        {{Form::hidden('club_id', $club_id)}}

        <div class="form-horizontal">
            <div class="form-group">
                {{ Form::label('game_table_id', 'Table No', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::select('game_table_id', $game_table, null, ['class' => "form-control"]) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('game_type_id', 'Game Type', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::select('game_type_id', $game_types, null, ['class' => "form-control"]) }}
                </div>
            </div>


            <div class="form-group">
                {{ Form::label('player_id', 'Player', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::select('player_id', $players, null, ['class' => "form-control"]) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('no_of_players', 'No. of Player', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::select('no_of_players', [1 => 1, 2 => 2, 4=>4], null, ['class' => "form-control"]) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('started_at', 'Started On', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::text( 'started_at', null, ['class' => "form-control", 'data-type' => 'datetime'] ) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('ended_at', 'Ended On', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::text( 'ended_at', null, ['class' => "form-control", 'data-type' => 'datetime'] ) }}
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            {{ Form::checkbox('completed') }} Completed ?
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ route('showGames', ['club_id'=> $club_id] ) }}" class="btn btn-default">Back to Game
                        Hall</a>
                </div>

            </div>

        </div>

    </div>


    {!! Form::close() !!}

@endsection

