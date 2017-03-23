@extends('layout.master')

@section('content')


    <div class="col-md-6 col-lg-offset-3">

        <h1>Bill Information
            <small>for Table {{$game->table->table_no}}</small>
        </h1>

        <h3>Client/Player: <strong>{{ $game->player->player_name }}</strong></h3>

        <h4>Game Type: <strong>{{ $game->game_type->game_type }}</strong></h4>

        @include('error._list')


        {!! Form::model($bill, ['route' => 'storeBill']) !!}

        {{Form::hidden('id', $bill->id)}}
        {{Form::hidden('game_id', $game->id)}}
        {{Form::hidden('club_id', $club_id)}}


        <div class="form-horizontal">
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
                        <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
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
                    <a href="{{ route('showGames', ['club_id'=> $club_id] ) }}" class="btn btn-default">Back to Game Hall</a>
                </div>

            </div>


        </div>


    </div>


    {!! Form::close() !!}

@endsection




