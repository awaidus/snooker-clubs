@extends('layout.master')

@section('content')

    <div class="col-md-6 col-md-offset-3">
        <h1>Game Type Info </h1>
        <div class="panel panel-default">
            <div class="panel-heading"></div>
            {!! Form::model($gameType, ['route' => 'storeGameType']) !!}

            {{Form::hidden('id')}}

            <div class="form-horizontal">

                {{Form::formInput('Game Type *', 'game_type')}}

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('home') }}" class="btn btn-default">
                            <i class="fa fa-arrow-back"></i>Back to Home
                        </a>

                    </div>

                </div>


            </div> {{--end form-group--}}
            {!! Form::close() !!}

        </div>


    </div>



@endsection


