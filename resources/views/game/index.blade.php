@extends('layout.master')

@section('content')

    <div>

        <h1>Game Hall
            <small>({{$club->club_name}})</small>
        </h1>

        <div class="row">
            <div class="col-md-12">

                @if(Sentinel::inRole('super') || Sentinel::inRole('admin'))
                    <a href="{{ route('showGameTable', ['club_id'=> $club->id, 'id' => -1] ) }}"
                       class="btn btn-default">
                        <i class="fa fa-plus" aria-hidden="true"></i> New Table
                    </a>
                @endif

                <a href="{{ route('showGame', ['id'=>null]) }}"
                   class="btn btn-info">
                    <i class="fa fa-plus"></i> New Game
                </a>

                <a href="{{route('showPlayers')}}" class="btn btn-default">
                    <i class="fa fa-list" aria-hidden="true"></i> Players</a>
                <a href="{{route('showTransactions')}}" class="btn btn-default">
                    <i class="fa fa-money" aria-hidden="true"></i> Payments Summery</a>

                <a href="#" class="btn btn-warning">
                    <i class="fa fa-list" aria-hidden="true"></i> All Games
                </a>
            </div>
        </div>

        </br>


        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">Game Tables</div>
                    <div class="panel-body">


                        @foreach($club->tables as $table)

                            <div class="panel panel-{{ ( false ) ? 'danger': 'info' }}">
                                <div class="panel-heading">
                                    {{ $table->table_no }}
                                    <a href="{{route('showGameTable', ['id'=> $table->id])}}"
                                       class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>

                                </div>
                                <div class="panel-body">
                                    <table class="table table-bordered table-hover table-condensed">
                                        <tr>
                                            <th>No. of Player</th>
                                            <th>Started at</th>
                                            <th>Ended at</th>
                                            <th>Bill</th>
                                            <th>Player</th>
                                            <th></th>
                                        </tr>
                                        @if (!is_null($table->games))
                                            @foreach($table->games as $game)
                                                @if( is_null($game->ended_at) )
                                                    <tr>
                                                        <td>{{ $game->no_of_players }}</td>
                                                        <td>{{ $game->started_at }}</td>
                                                        <td>{{ $game->ended_at }}</td>
                                                        <td>{{ $game->bill - $game->discount }}</td>
                                                        <td>{{ $game->player->player_name }}</td>
                                                        <td>
                                                            <a href="{{ route('showGame', ['table_id'=>$table->id, 'id'=>$game->id]) }}"
                                                               class="btn btn-default btn-sm"><i
                                                                        class="fa fa-pencil"></i></a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif

                                    </table>
                                </div>
                            </div>

                        @endforeach


                    </div>

                </div>


            </div>

            <div class="col-md-4">

                <div class="panel panel-success">
                    <div class="panel-heading">Total Bills</div>

                    <table class="table table-hover table-condensed">
                        <tr>
                            <th>Table</th>
                            <th>Today - Discount</th>
                            <th>This Month</th>
                        </tr>

                        @foreach($bills as $table => $bill)
                            <tr>
                                <td>{{$table}}</td>

                                <td>
                                    <div>
                                        {{ $bill['today']['bill'] }}
                                        <span class="label label-default">{{ $bill['today']['discount'] }}</span>
                                    </div>
                                </td>

                                <td> {{ $bill['thisMonth'] }} </td>

                            </tr>
                        @endforeach

                        <tr>
                            <td><h3>Total</h3></td>
                            <td><h3><span class="label label-success">{{ $totals['today'] }}</span></h3></td>
                            <td><h3><span class="label label-success">{{ $totals['thisMonth'] }}</span></h3></td>
                        </tr>


                    </table>


                </div>

                <div class="panel panel-danger">
                    <div class="panel-heading">Total Balance<strong> </strong></div>


                    <table class="table table-condensed table-hover">
                        <tr>
                            <th>Client</th>
                            <th>Games</th>
                            <th></th>
                        </tr>
                        {{--@foreach($club->games as $game)--}}

                        {{--@if (! is_null($game->bill) && ! $game->bill->full_paid )--}}
                        {{--<tr>--}}
                        {{--<td>--}}
                        {{--<div><strong>{{$game->table->table_no}}</strong></div>--}}
                        {{--<div>{{($game->started_at) ? $game->started_at->format('d-m-y') : ''}}</div>--}}
                        {{--</td>--}}
                        {{--<td></td>--}}
                        {{--<td>{{$game->bill->bill - $game->bill->discount}}</td>--}}
                        {{--@php($total_pending_bills = $total_pending_bills + $game->bill->bill - $game->bill->discount)--}}
                        {{--<td>--}}
                        {{--<a href="{{ route('showGame', ['club_id'=> $club->id, 'id' => $game->id] ) }}"--}}
                        {{--class="btn btn-danger btn-xs">--}}
                        {{--<i class="fa fa-arrow-right" aria-hidden="true"></i>--}}
                        {{--</a>--}}
                        {{--</td>--}}
                        {{--</tr>--}}
                        {{--@endif--}}
                        {{--@endforeach--}}
                        @php($total_balance = 0)
                        @foreach($players as $player)
                            @if( $player->transactions->sum('amount') < 0 )
                                @php($total_balance = $total_balance + $player->transactions->sum('amount'))

                                <tr>
                                    <td>{{ $player->player_name }}
                                        <span class="label label-danger">{{ $player->transactions->sum('amount') }}</span>
                                    </td>
                                    <td>
                                        {{--@foreach($player->games as $game)--}}
                                        {{--<div>{{$game->game_type->game_type}} - --}}
                                        {{--{{$game->started_at}}</div>--}}
                                        {{--@endforeach--}}
                                    </td>
                                    <td>
                                        <a href="{{ route('showPlayerTransaction', ['id'=> $player->id]) }}"
                                           class="btn btn-default btn-sm"><i class="fa fa-arrow-right"></i>
                                        </a>
                                    </td>
                                </tr>

                            @endif

                        @endforeach

                        <tr>
                            <td><h3>Total</h3></td>
                            <td><h3><span class="label label-danger">{{ $total_balance }}</span></h3></td>
                        </tr>

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
{{--class="label label-danger">{{ $game->no_of_players }}</span></li>--}}
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