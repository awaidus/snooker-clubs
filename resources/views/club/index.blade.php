@extends('layout.master')

@section('content')
    <div>
        <h2>Dashboard</h2>

        @include('alert._error')
        @include('alert._success')

        @if(Sentinel::inRole('super') || Sentinel::inRole('admin'))
            <div class="row">
                <div class="col-sm-3">
                    <a href="{{route('showClub')}}" class="btn btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i> New Club
                    </a>
                </div>
            </div>

            @endif


            </br>


            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Clubs</div>

                        <table class="table table-bordered table-condensed table-hover">
                            <tr>
                                <th>Club</th>
                                <th>Tables</th>
                                <th>Bill</th>
                                <th></th>
                            </tr>
                            @php($pending_bills = 0)
                            @php($total_bills = 0)

                            @foreach($clubs as $club)
                                <tr>
                                    <td><strong> {{ $club->club_name }}</strong> ({{ $club->club_address }})</td>
                                    <td>{{ $club->no_of_tables }}
                                        <span class="badge">Active: {{ $club->games()->where('completed', false)->count('completed')  }}</span>
                                    </td>

                                    <td>
                                        @foreach($club->tables as $table)
                                            @php($pending_bills = $pending_bills + $table->bills->where('full_paid', false)->sum('paid') )
                                            @php($total_bills = $total_bills + $table->bills->sum('bill') )
                                        @endforeach
                                        <div>Bills: {{ $total_bills }}</div>
                                        <div>Balances: {{ $pending_bills }}</div>
                                    </td>

                                    <td>
                                        <a class="btn btn-default" data-toggle="tooltip" data-placement="left"
                                           title="Open Game Hall"
                                           href="{{ route('showGames', ['club_id'=> $club->id] ) }}">
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                        @if(Sentinel::inRole('super') || Sentinel::inRole('admin'))
                                            <a class="btn btn-warning btn-xs" data-toggle="tooltip"
                                               data-placement="left" title="Edit"
                                               href="{{ route('showClub', ['club_id'=> $club->id] ) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>


                {{--<div class="col-md-3">--}}
                {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Total Bills</div>--}}
                {{--<div class="list-group">--}}
                {{--<li class="list-group-item">Total Bill Amount--}}
                {{--<span class="badge">{{ $bills->sum('bill') }}</span></li>--}}
                {{--<li class="list-group-item">Total Payment Received--}}
                {{--<span class="badge">{{ $bills->sum('paid') }}</span></li>--}}
                {{--<li class="list-group-item list-group-item-danger">Total Balance Amount--}}
                {{--<span class="badge">{{ $bills->where('full_paid', false)->sum('paid') }}</span></li>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}



                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Clients / Players
                        </div>
                        <div class="list-group">
                            @foreach($players as $player)
                                <a class="list-group-item" href="">
                                    {{ $player->player_name }}
                                    <span class="badge">{{ $player->bills()->sum('paid') }}</span></a>
                            @endforeach


                        </div>
                    </div>
                </div>

            </div>


    </div>
@endsection

