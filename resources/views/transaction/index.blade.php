@extends('layout.master')

@section('content')
    <div>
        <h2>Transactions Summery</h2>
        <div class="row">
            <div class="col-md-9">

                {!! Form::open(['route' => ['showTransactions'], 'method' => 'get', 'class' => 'form-inline']) !!}

                <div class="form-group">
                    {!! Form::text('dateFrom', Request::get('dateFrom'), ['class'=>'form-control', 'data-type'=>'date', 'placeholder'=>'Date From..']) !!}
                </div>

                <div class="form-group">
                    {!! Form::text('dateTo', Request::get('dateTo'), ['class'=>'form-control', 'data-type'=>'date', 'placeholder'=>'Date To..']) !!}
                </div>

                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Search
                </button>

                <a href="{{ route('showGames', ['club_id'=> session('club_id')]) }}"
                   class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back to Game Hall
                </a>

                {!! Form::close() !!}

            </div>
        </div>

        @php($total_bill = 0)
        @php($total_payments = 0)
        <table class="table table-bordered table-striped table-hover">
            <tr class="default">
                <th class="col-md-2">Date</th>
                <th class="col-md-3">Due Amounts</th>
                <th class="col-md-3">Received Amounts</th>
            </tr>


            @foreach($games as $working_day => $game)

                @php($total_bill = $total_bill + ($game->sum('bill') - $game->sum('discount')) )
                @php($total_payments = $total_payments + $game->sum('total_payments')  )
                <tr>
                    <td>{{ $working_day }}</td>
                    <td>{{ $game->sum('bill') - $game->sum('discount') }}</td>
                    <td>{{ $game->sum('total_payments')  }}</td>
                </tr>

            @endforeach {{--$games--}}

            <tr class="success">
                <td><strong>Total</strong></td>
                <td><strong>{{ $total_bill }}</strong></td>
                <td><strong>{{ $total_payments }}</strong></td>
            </tr>

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


