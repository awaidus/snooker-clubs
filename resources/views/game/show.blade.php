@extends('layout.master')

@section('content')


    <div class="col-md-9 col-lg-offset-1">

        <h1>Game Information</h1>

        @include('error._list')


        <div class="form-horizontal">

            <div class="row">

                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Game Table</div>
                        <div class="panel-body">
                            {!! Form::model($game, ['route' => 'storeGame']) !!}

                            {{Form::hidden('id')}}
                            {{Form::hidden('club_id', $club_id)}}

                            <div class="form-group">
                                {{ Form::label('game_table_id', 'Table No', ['class'=> 'col-sm-3 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('game_table_id', $game_table, (! $game) ? request()->get('table_id'): null, ['class' => "form-control"]) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('game_type_id', 'Game Type', ['class'=> 'col-sm-3 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('game_type_id', $game_types, null, ['class' => "form-control"]) }}
                                </div>
                            </div>


                            <div class="form-group">
                                {{ Form::label('player_id', 'Player', ['class'=> 'col-sm-3 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('player_id', $players, null, ['class' => "form-control"]) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('no_of_players', 'No. of Player', ['class'=> 'col-sm-3 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('no_of_players', [1 => 1, 2 => 2, 4=>4], null, ['class' => "form-control"]) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('started_at', 'Started At', ['class'=> 'col-sm-3 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text( 'started_at', null, ['class' => "form-control", 'data-type' => 'datetime'] ) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('ended_at', 'Ended At', ['class'=> 'col-sm-3 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text( 'ended_at', null, ['class' => "form-control", 'data-type' => 'datetime'] ) }}
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            {{ Form::checkbox('completed') }} Completed ?
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>

                            </div>

                            {!! Form::close() !!}

                        </div>

                    </div>

                </div>


                <div class="col-md-6">
                    @if((! empty($game->bill)))
                        <div class="panel panel-{{ ($game->bill->full_paid) ? 'success' : 'danger' }}">
                            <div class="panel-heading">Bill</div>
                            <div class="panel-body">{!! Form::model($game->bill, ['route' => 'storeBill']) !!}

                                {{Form::hidden('id', $game->bill->id)}}
                                {{Form::hidden('game_id', $game->id)}}
                                {{Form::hidden('club_id', $club_id)}}


                                <div class="form-group">
                                    {{ Form::label('bill', 'Bill Amount', ['class'=> 'col-sm-3 control-label']) }}
                                    <div class="col-sm-9">
                                        {{ Form::text('bill', null, ['class' => "form-control"]) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('discount', 'Discount', ['class'=> 'col-sm-3 control-label']) }}
                                    <div class="col-sm-9">
                                        {{ Form::input('text', 'discount', null, ['class' => "form-control"]) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('paid', 'Total Paid Amount', ['class'=> 'col-sm-3 control-label']) }}
                                    <div class="col-sm-9">
                                        {{ Form::input('text', 'paid', null, ['class' => "form-control"]) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('bill_date', 'Bill Date', ['class'=> 'col-sm-3 control-label']) }}
                                    <div class="col-sm-9">
                                        <div class='input-group date'>
                                            {{ Form::text( 'bill_date', null, ['class' => "form-control", 'data-type' => 'date'] ) }}
                                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <div class="checkbox">
                                            <label>
                                                {{ Form::checkbox('full_paid') }} Fully Paid ?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>

                                </div>


                                {!! Form::close() !!}</div>
                        </div>
                    @else
                        <div class="panel panel-danger">
                            <div class="panel-heading">Bill</div>
                            <div class="panel-body">Save / Create the Game Table first.</div>
                        </div>
                    @endif

                </div>


            </div>


        </div>
        <a href="{{ route('showGames', ['club_id'=> $club_id] ) }}" class="btn btn-default btn-block">
            <i class="fa fa-arrow-circle-left"></i> Back to Hall</a>
    </div>




@endsection

