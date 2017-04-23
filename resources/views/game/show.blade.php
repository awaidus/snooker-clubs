@extends('layout.master')

@section('content')

    <h1>Game Information</h1>

    <!-- Modal -->
    <div class="modal fade" id="playerModal" tabindex="-1" role="dialog" aria-labelledby="newPlayerModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="newPlayerModal">Modal title</h4>
                </div>
                <div class="modal-body">

                    {!! Form::open(['route' => 'storePlayer', 'id'=>'playerForm'] ) !!}

                    {{Form::hidden('id', null)}}


                    <div class="form-horizontal">

                        {{Form::formInput('Player Name', 'player_name', null, ['required'])}}

                        {{Form::formInput('Contact No.', 'contact', null)}}


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>

                        </div>


                    </div> {{--end form-group--}}

                </div>


                {!! Form::close() !!}

            </div>

        </div>
    </div>




    <div class="form-horizontal">

        <div class="row">

            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Game Table</div>
                    <div class="panel-body">


                        {!! Form::model($game, ['route' => 'storeGame']) !!}

                        {{Form::hidden('id')}}

                        {{Form::formInput('Working Day *', 'working_day', null, ['data-type' => 'date'])}}

                        <div class="form-group">
                            {{ Form::label('player_id', 'Player', ['class'=> 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">
                                <div class="input-group">
                                    {{ Form::select('player_id', $players,
                                        (!is_null($game) ) ? $game->player_ids : [], [ 'name' => 'player_ids[]', 'class' => "form-control", 'multiple']) }}
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#playerModal">Add
                                        </button>
                                    </span>
                                </div>

                            </div>
                        </div>

                        {{Form::formSelect('Table', 'game_table_id', $game_tables)}}
                        {{Form::formSelect('Game Type', 'game_type_id',$game_types)}}
                        {{Form::formSelect('No. of Player', 'no_of_players', [1 => 1, 2 => 2, 3 => 3, 4=>4], null)}}
                        {{Form::formInput('Bill Amount *', 'bill')}}
                        {{Form::formInput('Discount', 'discount')}}
                        {{Form::formInput('Started At *', 'started_at', (($game && $game->started_at)) ? $game->started_at->format('d-m-Y g:i A'): null, ['data-type' => 'datetime'])}}
                        {{Form::formInput('Ended At', 'ended_at', null, ['data-type' => 'datetime'])}}


                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>

                        </div>

                        {!! Form::close() !!}


                    </div>

                </div>

            </div>

            @if( ! (is_null($game) || is_null($game->players)) && $game->players->count('player_name') >1 )
                <div class="col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">Bill Shares as per Player</div>
                        <div class="panel-body">

                            @foreach($game->players as $player)
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>{{ $player->player_name }}</h4>
                                            {!! Form::model($player->transactions->first(), ['route' => 'storeUserShare']) !!}
                                            {{Form::hidden('id')}}
                                            {{Form::hidden('game_id', $game->id)}}
                                            <div class="input-group">
                                                {{Form::text('amount', -$player->transactions->first()->amount, ['class'=>'form-control'])}}
                                                <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit">Save</button>
                                            </span>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endif

        </div>


    </div>
    <a href="{{ route('showGames', ['club_id'=> session('club_id')] ) }}" class="btn btn-default btn-block">
        <i class="fa fa-arrow-circle-left"></i> Back to Hall</a>
    </div>




@endsection

@section('script')
    <script>

        var playersDD = $("#player_id");

        playersDD.select2();


        $('#playerForm').submit(function (e) {

            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var data = form.serialize();


            $.post(url, data, function () {

                $.getJSON('{{ url("api/players") }}', function (results) {

                    playersDD.select2({
                        data: $.map(results, function (val, i) {
                            return {id: i, text: val};
                        })
                    });
                    console.log(results);
                });

                $('#playerModal').modal('hide');


                //$(".modal .modal-content").html(data);
            });

            $('#playerModal').modal('hide');

        });

    </script>

@endsection














{{--<div class="col-md-6">--}}
{{--@if((! empty($game->bill)))--}}

{{--<div class="panel panel-{{ ($game->bill->full_paid) ? 'success' : 'danger' }}">--}}
{{--<div class="panel-heading">Bill</div>--}}
{{--<div class="panel-body">--}}

{{--{!! Form::model($game->bill, ['route' => 'storeBill']) !!}--}}

{{--{{Form::hidden('id', $game->bill->id)}}--}}
{{--{{Form::hidden('game_id', $game->id)}}--}}

{{--{{Form::formInput('Bill Amount', 'bill')}}--}}
{{--{{Form::formInput('Discount', 'discount')}}--}}


{{--<div class="form-group">--}}
{{--<div class="col-sm-offset-3 col-sm-9">--}}
{{--<button type="submit" class="btn btn-success">Save</button>--}}
{{--</div>--}}

{{--</div>--}}


{{--{!! Form::close() !!}--}}


{{--<h3>Payment</h3>--}}

{{--<table class="table table-bordered table-hover table-condensed">--}}

{{--<tr>--}}
{{--<th>Amount</th>--}}
{{--<th>Date</th>--}}
{{--<th></th>--}}

{{--</tr>--}}

{{--@foreach($game->bill->transactions as $transaction)--}}
{{--{!! Form::model($transaction, ['route' => 'storeTransaction']) !!}--}}
{{--{{Form::hidden('id', $transaction->id)}}--}}
{{--{{Form::hidden('game_id', $game->id)}}--}}
{{--<tr>--}}
{{--<td>{{ Form::text('amount', null, ['class' => "form-control", 'placeholder' => 'Amount']) }}</td>--}}
{{--<td>{{ Form::text('receive_date', null, ['class' => "form-control", 'data-type' => 'date'] ) }}</td>--}}
{{--<td>--}}
{{--<button type="submit" class="btn btn-success btn-small">Save</button>--}}
{{--</td>--}}
{{--</tr>--}}
{{--{!! Form::close() !!}--}}
{{--@endforeach--}}

{{--{!! Form::open(['route' => 'storeTransaction']) !!}--}}
{{--{{Form::hidden('id', null)}}--}}
{{--{{Form::hidden('bill_id', $game->bill->id)}}--}}
{{--{{Form::hidden('game_id', $game->id)}}--}}

{{--<tr>--}}
{{--<td>{{ Form::text('amount', null, ['class' => "form-control", 'placeholder' => 'Amount']) }}</td>--}}
{{--<td>{{ Form::text('receive_date', null, ['class' => "form-control", 'data-type' => 'date'] ) }}</td>--}}
{{--<td>--}}
{{--<button type="submit" class="btn btn-primary btn-small">Add</button>--}}
{{--</td>--}}
{{--</tr>--}}
{{--{!! Form::close() !!}--}}


{{--</table>--}}

{{--</div> panel-body--}}


{{--</div>--}}

{{--@else--}}
{{--<div class="panel panel-warning">--}}
{{--<div class="panel-heading">Bill</div>--}}
{{--<div class="panel-body">Save the Game Table first.</div>--}}
{{--</div>--}}
{{--@endif--}}

{{--</div>--}}

