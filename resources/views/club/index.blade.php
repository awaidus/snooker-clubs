@extends('layout.master')

@section('content')
    <div>
        <h2>Dashboard</h2>

        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="row">
            <div class="col-sm-3">
                <a href="{{route('showClub')}}" class="btn btn-primary">
                    <i class="fa fa-plus" aria-hidden="true"></i> New Club
                </a>
            </div>
        </div>


        </br>


        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Clubs</h4>
                    </div>
                    <div class="list-group">
                        @foreach($clubs as $club)
                            <a class="list-group-item" href="{{ route('showGames', ['club_id'=> $club->id] ) }}">
                                <strong> {{ $club->club_name }}</strong> ( {{ $club->club_address }} )
                                <div>No. of Tables: {{ $club->no_of_tables }}
                                    <span class="badge">Active: {{ $club->games()->where('completed', false)->count('completed')  }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Total Bills</h4>
                    </div>
                    <div class="list-group">
                        <li class="list-group-item">Total Bill Amount
                            <span class="badge">{{ $bills->sum('bill') }}</span></li>
                        <li class="list-group-item">Total Payment Received
                            <span class="badge">{{ $bills->sum('paid') }}</span></li>
                        <li class="list-group-item list-group-item-danger">Total Balance Amount
                            <span class="badge">{{ $bills->where('full_paid', false)->sum('paid') }}</span></li>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Clients / Players</h4>
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

