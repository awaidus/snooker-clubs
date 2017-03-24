@extends('layout.master')

@section('content')
    <div>
        <h2>Bills Summery</h2>

        @include('alert._success')

        <br>

            <table class="table table-bordered table-hover">
                <tr class="default">
                    <th>Game Table</th>
                    <th>Player</th>
                    <th>Bill</th>
                    <th>Bill Date</th>
                    <th>Is fully paid?</th>
                    <th></th>
                </tr>
                @foreach($bills as $bill)
                    <tr class="{{ (! $bill->full_paid ) ? 'danger' : '' }}" >
                        <td>
                            <div>{{ $bill->game->table->table_no }}</div>
                            <div>[ {{ ($bill->game->started_at) ? $bill->game->started_at->format('d-M-y') : '' }}]</div>
                        </td>
                        <td>
                            {{ $bill->game->player->player_name }}
                        </td>
                        <td>
                            <div>BILL : <span class="label label-default">{{$bill->bill - $bill->discount}}</span></div>
                            <div>PAID : <span class="label label-primary">{{$bill->paid}}</span></div>
                        </td>
                        <td>
                            {{ ($bill->bill_date) ? $bill->bill_date->format('d-m-Y'): '' }}
                        </td>
                        <td>
                            {{ ($bill->full_paid) ? 'Yes': 'No' }}
                        </td>
                        <td>
                            <a href="{{ route('showBill', ['game_id'=> $bill->game->id, 'club_id' => Session::get('club_id'), 'id' => $bill->id] ) }}"
                               class="btn btn-default"><i class="fa fa-edit" aria-hidden="true"></i> Open
                            </a>
                        </td>
                    </tr>
                @endforeach

            </table>



    </div>
@endsection

