@extends('layout.master')

@section('content')
    <h1>Create Game</h1>

    <div class="col-md-6 col-lg-offset-3">

        {!! Form::open(['route' => 'storeGame']) !!}

        {{Form::hidden('id', null)}}

        <div class="form-group">
            {{ Form::label('game_table_id', 'Table No') }}
            {{ Form::select('game_table_id', $game_table, null, ['class' => "form-control"]) }}
        </div>

        <div class="form-group">
            {{ Form::label('game_type_id', 'Game Type') }}
            {{ Form::select('game_type_id', $game_types, null, ['class' => "form-control"]) }}
        </div>

        <div class="form-group">
            {{ Form::label('player_id', 'Player') }}
            {{ Form::select('player_id', $players, null, ['class' => "form-control"]) }}
        </div>

        <div class="form-group">
            {{ Form::label('no_of_players', 'No. of Players') }}
            {{ Form::select('no_of_players', [1 => 1, 2 => 2, 4=>4], null, ['class' => "form-control"]) }}
        </div>

        <div class="form-group">
            {{ Form::label('started_at', 'Started At') }}
            <div class='input-group date' data-type ='datetime'>
                {{ Form::text( 'started_at', null, ['class' => "form-control"]) }}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('ended_at', 'Ended At') }}
            <div class='input-group date' data-type ='datetime'>
                {{ Form::input('text', 'ended_at', null, ['class' => "form-control"]) }}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <div class="checkbox">
            <label>
                {{ Form::checkbox('completed', null, null) }} Completed ?
            </label>
        </div>

        <button type="submit" class="btn btn-default">Save</button>


    </div>


    {!! Form::close() !!}

@endsection

