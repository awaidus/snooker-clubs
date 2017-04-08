@extends('layout.master')

@section('content')

    @include('layout._admin-site-menu')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="col-md-6">

            <h1>Game Table Information
                <small>for Club {{$club->club_name}} </small>
            </h1>


            @include('error._list')


            {!! Form::open(['route' => 'storeGameTable']) !!}

            {{Form::hidden('id', $table->id)}}
            {{Form::hidden('club_id', $club->id)}}

            <div class="form-group">
                {{ Form::label('table_no', 'Table No') }}
                {{ Form::input('text', 'table_no', $table->table_no, ['class' => "form-control"]) }}
            </div>

            <button type="submit" class="btn btn-success">Save</button>

            <a href="{{ route('showGames', ['club_id'=> $club->id] ) }}" class="btn btn-default">Back to Game Hall</a>

            {!! Form::close() !!}

        </div>


    </div>

@endsection




