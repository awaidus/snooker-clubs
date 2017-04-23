@extends('layout.master')

@section('content')

    <div class="row">
        <div class="col-md-9">
            <a href="{{ route('showGames', ['club_id'=> session('club_id')]) }}"
               class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back to Game Hall
            </a>

        </div>
    </div>

    <br>


    <games-list club-id="{{session('club_id')}}">
        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
        <span class="sr-only">Loading...</span>
    </games-list>

@endsection
