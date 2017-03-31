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
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">Game Tables</div>
                <div class="panel-body">


                    @foreach($club->tables as $table)

                        @if($table->games->count() == 0)
                            <div class="col-md-6">
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
                                                            class="label label-default"> {{$game->started_at}}</span>
                                                </li>
                                                <li class="list-group-item">Ended At: <span
                                                            class="label label-default">{{$game->ended_at}}</span></li>
                                                <li class="list-group-item">No. of Players: <span
                                                            class="label label-default">{{$game->no_of_players}}</span>
                                                </li>
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

        <div class="col-md-4">

            <div class="panel panel-success">
                <div class="panel-heading">Bill Totals</div>

                <table class="table table-bordered table-hover table-condensed">
                    <tr>
                        <th>Table</th>
                        <th>Today</th>
                        <th>This Month</th>
                    </tr>

                    @foreach($club->tables as $table)
                        <tr>
                            <td>{{$table->table_no}}</td>
                            <td>
                                @if (! is_null($table->bills) )
                                    {{ $table->bills->filter(function ($value, $key) {
                                    if (!is_null($value->bill_date))
                                        return $value->bill_date->isToday();
                                    })->sum('paid') }}
                                @endif

                            </td>
                            <td>
                                @if (! is_null($table->bills) )
                                    {{ $table->bills->filter(function ($value, $key) {
                                    if (!is_null($value->bill_date))
                                        return $value->bill_date->month == \Carbon\Carbon::now()->month;
                                    })->sum('paid') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </table>


            </div>

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
                        @php($total_pending_bills = 0)
                        @if (! is_null($game->bill) && ! $game->bill->full_paid )
                            <tr>
                                <td>
                                    <div><strong>{{$game->table->table_no}}</strong></div>
                                    <div>{{($game->started_at) ? $game->started_at->format('d-m-y') : ''}}</div>
                                </td>
                                <td></td>
                                <td>{{$game->bill->bill - $game->bill->discount}}</td>
                                @php($total_pending_bills = $total_pending_bills + $game->bill->bill - $game->bill->discount)
                                <td>
                                    <a href="{{ route('showGame', ['club_id'=> $club->id, 'id' => $game->id] ) }}"
                                       class="btn btn-danger btn-xs">
                                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach

                    <tr>
                        <td></td>
                        <td><h3>Total <span class="label label-danger">{{ $total_pending_bills }}</span></h3></td>
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