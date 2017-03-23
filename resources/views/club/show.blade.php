@extends('layout.master')

@section('content')


    <div class="col-md-6 col-lg-offset-3">

        <h1>Club Information </h1>

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

        {!! Form::open(['route' => 'storeClub']) !!}

        {{Form::hidden('id', $club->id)}}

        <div class="form-group">
            {{ Form::label('club_name', 'Club Name') }}
            {{ Form::input('text', 'club_name', $club->club_name, ['class' => "form-control"]) }}
        </div>

        <div class="form-group">
            {{ Form::label('club_address', 'Address') }}
            {{ Form::input('text', 'club_address', $club->club_address, ['class' => "form-control"]) }}
        </div>

        <div class="form-group">
            {{ Form::label('no_of_tables', 'No. of Tables') }}
            {{ Form::input('text', 'no_of_tables', $club->no_of_tables, ['class' => "form-control"]) }}
        </div>

        <button type="submit" class="btn btn-success">Save</button>

        <a href="{{ route('home') }}" class="btn btn-default">Back to Home</a>


    </div>


    {!! Form::close() !!}

@endsection




