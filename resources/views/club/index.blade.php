@extends('layout.master')

@section('content')
    <div>
        <h2>Dashboard</h2>

        @if(Sentinel::inRole('super') || Sentinel::inRole('admin'))
            <div class="row">
                <div class="col-sm-3">
                    <a href="{{route('showClub')}}" class="btn btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i> New Club
                    </a>
                </div>
            </div>
        @endif


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Clubs</div>

                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Club</th>
                            <th>Tables</th>
                            <th>Bill</th>
                            <th></th>
                        </tr>
                        @foreach($clubs as $club)
                            <tr>
                                <td><strong> {{ $club->club_name }}</strong> ({{ $club->club_address }})</td>
                                <td>{{ $club->no_of_tables }}
                                    <span class="badge">Active: {{ $club->games()->where('ended_at', '=', null)->count('ended_at')  }}</span>
                                </td>

                                <td>
                                    <div>Bills: {{ $club->games->sum('bill') }}</div>
                                    <div>discount: {{ $club->games->sum('discount') }}</div>
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

