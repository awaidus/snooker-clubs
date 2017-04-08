@extends('layout.master')

@section('content')
    @include('layout._admin-site-menu')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">


        <div class="col-md-6 col-lg-offset-3">
            <h1>Player Information </h1>
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                {!! Form::model($player, ['route' => 'storePlayer']) !!}

                {{Form::hidden('id')}}

                <div class="form-horizontal">

                    {{Form::formInput('Name *', 'player_name')}}
                    {{Form::formInput('Contact No.', 'contact')}}
                    {{Form::formSelect('Club', 'club_id',$clubs)}}


                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ route('showGames', ['club_id'=> session('club_id')] ) }}"
                               class="btn btn-default">
                                Back to Game Hall
                            </a>

                        </div>

                    </div>


                </div> {{--end form-group--}}
                {!! Form::close() !!}

            </div>


        </div>

    </div>

@endsection


