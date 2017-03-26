@extends('layout.master')

@section('content')
</br>
<div>

    <h1>Game Hall
        <small>({{$club->club_name}})</small>
    </h1>

    <div class="row">
        <div class="col-md-6">

            @if(Sentinel::inRole('super') || Sentinel::inRole('admin'))
                <a href="{{ route('showGameTable', ['club_id'=> $club->id, 'id' => -1] ) }}" class="btn btn-default">
                    <i class="fa fa-plus" aria-hidden="true"></i> New Table
                </a>
            @endif

            {{--<a href="{{ route('showGame', ['club_id'=> $club->id, 'id' => -1] ) }}" class="btn btn-primary">--}}
            {{--<i class="fa fa-plus" aria-hidden="true"></i> New Game--}}
            {{--</a>--}}

            <a href="#" class="btn btn-warning">
                <i class="fa fa-list" aria-hidden="true"></i> All Games
            </a>
        </div>
    </div>

    </br>


    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-primary">
                <div class="panel-heading">Game Tables</div>
                <div class="panel-body">


                    @foreach($club->tables as $table)

                        @if($table->games->count() == 0)
                            <div class="col-md-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading">{{$table->table_no}}</div>
                                    <div class="panel-body">
                                        <a href="{{ route('showGame', ['club_id'=> $club->id, 'id' => null, 'table_id' => $table->id] ) }}"
                                           class="btn btn-primary">
                                            <i class="fa fa-plus" aria-hidden="true"></i> New Game
                                        </a>
                                    </div>
                                </div>
                            </div>

                        @else

                            @foreach($table->games as $game)
                                <div class="col-md-6">
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">{{$table->table_no}}</div>
                                        <div class="panel-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">Started At: <span
                                                            class="badge"> {{$game->started_at}}</span></li>
                                                <li class="list-group-item">Ended At: <span
                                                            class="badge">{{$game->ended_at}}</span></li>
                                                <li class="list-group-item">No. of Players: <span
                                                            class="badge">{{$game->no_of_players}}</span></li>
                                                <li class="list-group-item">
                                                    <a href="{{ route('showGame', ['club_id'=> $club->id, 'id' => $game->id] ) }}"
                                                       class="btn btn-default btn-block">
                                                        <i class="fa fa-edit" aria-hidden="true"></i> Open
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @endif

                    @endforeach


                </div>

            </div>


        </div>

        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">Pending Bills<strong> </strong></div>


                <table class="table table-condensed table-hover">
                    <tr>
                        <th>Table</th>
                        <th>Clients</th>
                        <th>Bill</th>
                        <th></th>
                    </tr>
                    @foreach($club->games as $game)

                        @if (! is_null($game->bill) && ! $game->bill->full_paid )
                            <tr>
                                <td>
                                    <div><strong>{{$game->table->table_no}}</strong></div>
                                    <div>{{($game->started_at) ? $game->started_at->format('d-m-y') : ''}}</div>
                                </td>
                                <td></td>
                                <td>{{$game->bill->bill - $game->bill->discount}}</td>
                                <td>
                                    <a href="{{ route('showGame', ['club_id'=> $club->id, 'id' => $game->id] ) }}"
                                       class="btn btn-danger btn-xs">
                                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif

                    @endforeach

                </table>


            </div> {{--End Panel--}}

        </div>


    </div>


</div>
@endsection


{{--<div class="col-md-6">--}}

{{--<div class="panel panel-{{($game->completed) ? 'default' : 'danger'}}">--}}
{{--<div class="panel-heading">Table No. <strong> {{ $game->table->table_no }} </strong>--}}
{{--</div>--}}
{{--<div class="panel-body">--}}
{{--<p>...</p>--}}
{{--</div>--}}
{{--<div class="panel-body">--}}
{{--<ul class="list-group">--}}
{{--<li class="list-group-item">No. of Players <span--}}
{{--class="badge">{{ $game->no_of_players }}</span></li>--}}
{{--<li class="list-group-item">Started At <span--}}
{{--class="badge">{{ $game->started_at }}</span>--}}
{{--</li>--}}
{{--<li class="list-group-item">Ended At <span--}}
{{--class="badge">{{ $game->ended_at }}</span>--}}
{{--</li>--}}
{{--<li class="list-group-item">Player / Client<span--}}
{{--class="badge">{{ $game->player->player_name }}</span></li>--}}
{{--</ul>--}}


{{--<a href="{{ route('showGame', ['club_id'=> $club->id, 'id' => $game->id] ) }}"--}}
{{--class="btn btn-primary btn-block">--}}
{{--<i class="fa fa-edit" aria-hidden="true"></i> Open--}}
{{--</a>--}}
{{--<a href="{{ route('showBill',--}}
{{--['game_id'=> $game->id,--}}
{{--'club_id' => $club->id,--}}
{{--'id' =>  (!is_null($game->bill)) ? $game->bill->id : '', ] ) }}"--}}
{{--class="btn btn-danger btn-block"> Bill--}}
{{--<i class="fa fa-arrow-right" aria-hidden="true"></i>--}}
{{--</a>--}}

{{--</div>--}}

{{--</div> --}}{{--End Panel--}}
{{--</div>--}}