@extends('layout.master')

@section('content')

    <div ng-controller="GameListCtrl as vm">

        <h1>Games List
            <small>@{{ vm.club.club_name }}</small>
        </h1>

        <div class="row">
            <div class="col-md-9">
                <a href="{{ route('showGames', ['club_id'=> session('club_id')]) }}"
                   class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back to Game Hall
                </a>
            </div>

            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" ng-model="query" autofocus placeholder="Type to search">
                </div>

            </div>

        </div>



        <table class="table table-bordered table-hover table-condensed">
            <tr>
                <th>Date/Time</th>
                <th>Game Type</th>
                <th>Game Bill</th>
                <th>Player</th>

            <tr ng-repeat="game in vm.games |  filter:query | orderBy: ['updated_at'] ">

                <td>@{{game.started_at.date | date : 'd/M/yy h:mm a'}}</td>
                <td>@{{game.game_type.game_type}}</td>
                <td>@{{game.bill}}</td>
                <td>
                    <li ng-repeat="player in game.players |  filter:query | orderBy: ['player_name'] ">
                        @{{player.player_name}} - @{{player.contact}}
                    </li>
                </td>

                <td>
                    <a href="{{route('showGame', ['id' => null])}}/@{{ game.id }}" class="btn btn-default">
                        <i class="fa fa-edit"></i></a>
                </td>


            </tr>

        </table>

    </div>

@endsection
