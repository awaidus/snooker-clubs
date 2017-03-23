@extends('layout.master')

@section('content')


    <div class="col-md-6 col-lg-offset-3">

        <h1>Player Information </h1>


        @include('error._list')


        {!! Form::model($player, ['route' => 'storePlayer']) !!}

        {{Form::hidden('id')}}

        <div class="form-group">
            {{ Form::label('player_name', 'Player Name') }}
            {{ Form::input('text', 'player_name', null, ['class' => "form-control"]) }}
        </div>

        <div class="form-group">
            {{ Form::label('contact', 'Contact No.') }}
            {{ Form::input('text', 'contact', null, ['class' => "form-control"]) }}
        </div>

        <button type="submit" class="btn btn-success">Save</button>

        <a href="{{ route('showGames', ['club_id'=> Session::get('club_id')] ) }}" class="btn btn-default">Back to Game Hall</a>


    </div>


    {!! Form::close() !!}

@endsection


