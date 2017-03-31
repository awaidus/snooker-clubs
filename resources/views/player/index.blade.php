@extends('layout.master')

@section('content')
    <div>
        <h2>Players List</h2>


        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('showPlayer', ['id'=> null]) }}"
                   class="btn btn-primary btn-block"><i class="fa fa-plus" aria-hidden="true"></i> New Client /
                    Player
                </a>
            </div>
        </div>

        </br>

        <table class="table table-bordered table-hover">
            <tr class="default">
                <th>Player Name</th>
                <th>Contact No.</th>
                <th>Total Paid</th>
                <th>Balance</th>

                <th></th>
            </tr>
            @foreach($players as $player)
                @foreach($player->sum_bills as $item)
                    <tr class={{ ($item->total_balance) ? 'danger': '' }}>
                        <td>
                            <div>{{ $player->player_name}}</div>
                        </td>
                        <td>
                            {{ $player->contact }}
                        </td>
                        <td>{{ $item->total_paid }}</td>
                        <td>{{ $item->total_balance }}</td>

                        <td>
                            <a href="{{ route('showPlayer', ['id'=> $player->id]) }}"
                               class="btn btn-default"><i class="fa fa-edit" aria-hidden="true"></i> Open
                            </a>
                        </td>

                    </tr>
                @endforeach
            @endforeach

        </table>

    </div>
@endsection

