@extends('layout.master')

@section('content')


    <div class="col-md-8 col-lg-offset-2">
        <h1><strong>{{ $player->player_name }}</strong>'s Transactions Info
        </h1>

        <div class="panel panel-warning">
            <div class="panel-heading">Payment</div>
            <div class="panel-body">

                <div class="col-md-7">
                    <div class="panel panel-success">
                        <div class="panel-heading"><h3>Make Payment</h3></div>

                        <div class="panel-body">

                            {!! Form::model($transaction, ['route' => 'storeTransaction']) !!}
                            {{Form::hidden('id')}}
                            {{Form::hidden('player_id', $player->id)}}

                            <div class="form-horizontal">
                                {{Form::formInput('Amount', 'amount')}}
                                {{Form::formInput('Received On *', 'receive_date', null, ['data-type' => 'date'])}}

                                {{Form::formSubmit()}}

                            </div>

                            {!! Form::close() !!}


                        </div>

                    </div>

                </div>

                <div class="col-md-5">
                    @if (($player->transactions->sum('amount')) < 0)
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h3>Balance
                                    <span class="label label-danger">{{ - ($player->transactions->sum('amount')) }}</span>
                                </h3>
                            </div>
                        </div>
                    @endif
                </div>

            </div>


            <a href="{{ route('showGames', ['club_id'=> session('club_id')] ) }}" class="btn btn-default btn-block">
                <i class="fa fa-arrow-circle-left"></i> Back to Game Hall</a>

        </div>


        <div class="panel panel-default">
            <div class="panel-heading">History</div>
            <div class="panel-body">
                <div class="col-md-7">
                    <div class="panel panel-info">
                        <div class="panel-heading">Games Summary</div>
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Bill</th>
                                <th>Date</th>

                                <th></th>
                            </tr>
                            @foreach($player->transactions as $transaction)
                                @if (! is_null(($transaction->game_id)))
                                    <tr>
                                        <td>{{ -($transaction->amount) }}</td>
                                        <td>Game:
                                            <span class="label label-default">{{ $transaction->game->game_type->game_type }}</span>
                                            {{ $transaction->game->started_at }}
                                        </td>
                                        <td>
                                            <a href="{{route('showGame', ['id' => $transaction->game->id])}}"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="panel panel-info">
                        <div class="panel-heading">Payment Summary</div>
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Amount</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            @foreach($player->transactions as $transaction)
                                @if ( is_null(($transaction->game_id)))
                                    <tr>
                                        <td>{{ ($transaction->amount) }}</td>
                                        <td>{{ ($transaction->receive_date) ? $transaction->receive_date->format('d-m-Y'): '' }}</td>
                                        <td>
                                            <a href="{{ route('showPlayerTransaction', ['id'=> $player->id, 'transaction_id'=> $transaction->id]) }}"
                                               class="btn btn-default btn-xs"><i class="fa fa-arrow-right"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>





@endsection


