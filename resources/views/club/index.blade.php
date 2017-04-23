@extends('layout.master')

@section('content')

    @include('layout._admin-site-menu')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        <h2>Dashboard</h2>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Clubs</div>

                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Club</th>
                            <th>Tables</th>
                            <th>Bills</th>
                            <th></th>
                        </tr>
                        @foreach($clubs as $club)
                            <tr>
                                <td><strong> {{ $club->club_name }}</strong> ({{ $club->club_address }})</td>
                                <td>{{ $club->no_of_tables }}
                                    <span class="badge">Active: {{ $club->games->where('ended_at', null)->count('ended_at')  }}</span>
                                </td>

                                <td>
                                    <div>Bills: <span class="label label-warning">
                                        {{ $club->games->sum('bill') - $club->games->sum('discount') }}</span></div>

                                    <div>Payments: <span class="label label-success">
                                        {{ $club->games->sum('total_payments') }}</span></div>
                                </td>

                                <td>
                                    <a class="btn btn-default" data-toggle="tooltip" data-placement="left"
                                       title="Open Game Hall"
                                       href="{{ route('showGames', ['club_id'=> $club->id] ) }}">
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                    @if(Sentinel::inRole('super') || Sentinel::inRole('admin'))
                                        <a class="btn btn-danger" data-toggle="tooltip"
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

        </div>


    </div>
@endsection

