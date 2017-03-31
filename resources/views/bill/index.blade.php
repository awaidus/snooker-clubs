@extends('layout.master')

@section('content')
    <div>
        <h2>Bills Summery</h2>

        @foreach($clubs as $club)

            <h3>{{ $club->club_name }}</h3>
            <table class="table table-bordered table-hover table-condensed">
                <tr>
                    <th>Date</th>
                    <th>Total Bill</th>
                    <th>Total Received Payment</th>
                </tr>

                @foreach ( $club->tables as $table)

                    @foreach ( $table->sum_bills as $bill )
                        <tr>
                            <td>{{ ($bill->bill_date) ? $bill->bill_date->format('d-M-Y') : ''}}</td>
                            <td>{{ $bill->total_bills }}</td>
                            <td>{{ $bill->total_paid }}</td>
                        </tr>
                    @endforeach
                @endforeach

            </table>


        @endforeach


        <table class="table table-bordered table-hover">
            <tr class="default">
                <th>Date</th>
                <th>Total Payment Received</th>
                <th>Bill</th>

                <th></th>
            </tr>

            @foreach($bills as $date => $bill)
                <tr>
                    <td> {{$date}}
                    </td>
                    <td> {{ $bill->sum('paid') }}</td>
                    <td> {{ $bill->sum('bill') }} </td>

                </tr>

            @endforeach

        </table>

    </div>
@endsection



{{--<table class="table table-bordered table-hover">--}}
{{--<tr class="default">--}}
{{--<th>Game Table</th>--}}
{{--<th>Player</th>--}}
{{--<th>Bill</th>--}}
{{--<th>Bill Date</th>--}}
{{--<th>Is fully paid?</th>--}}
{{--<th></th>--}}
{{--</tr>--}}
{{--@foreach($bills as $bill)--}}
{{--<tr class="{{ (! $bill->full_paid ) ? 'danger' : '' }}">--}}
{{--<td>--}}
{{--<div>{{ $bill->game->table->table_no }}</div>--}}
{{--<div>[ {{ ($bill->game->started_at) ? $bill->game->started_at->format('d-M-y') : '' }}]</div>--}}
{{--</td>--}}
{{--<td>--}}
{{--{{ $bill->game->player->player_name }}--}}
{{--</td>--}}
{{--<td>--}}
{{--<div>BILL : <span class="label label-default">{{$bill->bill - $bill->discount}}</span></div>--}}
{{--<div>PAID : <span class="label label-primary">{{$bill->paid}}</span></div>--}}
{{--</td>--}}
{{--<td>--}}
{{--{{ ($bill->bill_date) ? $bill->bill_date->format('d-m-Y'): '' }}--}}
{{--</td>--}}
{{--<td>--}}
{{--{{ ($bill->full_paid) ? 'Yes': 'No' }}--}}
{{--</td>--}}
{{--<td>--}}
{{--<a href="{{ route('showGame', ['club_id'=> session('club_id'), 'id' => $bill->game->id] ) }}"--}}
{{--class="btn btn-default"><i class="fa fa-edit" aria-hidden="true"></i>--}}
{{--</a>--}}

{{--</td>--}}
{{--</tr>--}}
{{--@endforeach--}}

{{--</table>--}}


