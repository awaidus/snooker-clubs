@extends('layout.master')

@section('content')

    <h1>Games List</h1>

    <div ng-controller="GameListCtrl as vm">

        <div class="row">
            <div class="col-md-9">


                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" ng-model="query" autofocus placeholder="Type to search">
                    </div>

                </div>

            </div>
        </div>


        <h4>Club: {{ $club->club_name }}</h4>
        <table class="table table-bordered table-hover table-condensed">
            <tr>
                <th>Date/Time</th>
                <th>Game Type</th>
                <th>Game Bill</th>
                <th>Player</th>
            </tr>
            @foreach($club->games as $game)
                <tr>
                    <td>{{$game->started_at}}</td>
                    <td>{{$game->game_type->game_type}}</td>
                    <td>{{$game->bill}}</td>
                    <td>{{$game->player->player_name}}</td>
                    <td><a href="{{route('showGame', ['id' => $game->id])}}" class="btn btn-default"><i
                                    class="fa fa-edit"></i></a></td>


                </tr>
            @endforeach
        </table>

    </div>

@endsection