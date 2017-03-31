@extends('layout.master')

@section('content')


    <div class="col-md-6 col-lg-offset-3">

        <h1>Player Information </h1>


        @include('error._list')


        {!! Form::model($player, ['route' => 'storePlayer']) !!}

        {{Form::hidden('id')}}

        <div class="form-horizontal">

            <div class="form-group">
                {{ Form::label('player_name', 'Name', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::text('player_name', null, ['class' => "form-control"]) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('contact', 'Contact No', ['class'=> 'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::text('contact', null, ['class' => "form-control"]) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                    <button type="submit" class="btn btn-success">Save</button>

                    <a href="{{ route('showGames', ['club_id'=> session('club_id')] ) }}" class="btn btn-default">
                        Back to Game Hall
                    </a>

                </div>

            </div>


        </div> {{--end form-group--}}

    </div>


    {!! Form::close() !!}

@endsection


