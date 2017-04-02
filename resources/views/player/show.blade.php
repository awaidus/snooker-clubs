@extends('layout.master')

@section('content')


    <div class="col-md-6 col-lg-offset-3">
        <h1>Player Information </h1>
        <div class="panel panel-default">
            <div class="panel-heading"></div>
            {!! Form::model($player, ['route' => 'storePlayer']) !!}

            {{Form::hidden('id')}}

            <div class="form-horizontal">

                {{Form::formInput('Name *', 'player_name')}}
                {{Form::formInput('Contact No.', 'contact')}}


                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('showGames', ['club_id'=> session('club_id')] ) }}" class="btn btn-default">
                            Back to Game Hall
                        </a>

                    </div>

                </div>


            </div> {{--end form-group--}}
            {!! Form::close() !!}

        </div>

        <div class="panel panel-warning">
            <div class="panel-heading">Payment</div>
            <div class="panel-body">

                <div class="col-md-7">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h3>Make Payment</h3></div>

                        <div class="panel-body">

                            {!! Form::model($player, ['route' => 'storePlayer']) !!}
                            {{Form::hidden('id')}}

                            <div class="form-group">
                                {{ Form::label('amount', '', ['class'=> 'control-label']) }}
                                {{ Form::text('amount', null, ['class' => "form-control"]) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('receive_date', 'Date', ['class'=> 'control-label']) }}
                                {{ Form::text('receive_date', null, ['class'=> 'form-control', 'data-type' => 'date']) }}
                            </div>

                            <button type="submit" class="btn btn-success"> Save</button>


                            {!! Form::close() !!}


                        </div>

                    </div>

                </div>

                <div class="col-md-5">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3>Balance <span
                                        class="label label-danger">{{ -($player->transactions->sum('amount')) }}</span>
                            </h3>
                        </div>

                        {{--<a href="#" class="btn btn-default btn-lg btn-block"><i class="fa fa-money"></i> Payment</a>--}}
                    </div>
                </div>

            </div>
        </div>


        <div class="panel panel-info">
            <div class="panel-heading">Payments Summary</div>
            <table class="table table-striped table-hover">
                <tr>
                    <th>Amount</th>
                    <th>Date</th>
                    <th></th>
                </tr>
                @foreach($player->transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ ($transaction->receive_date) ? $transaction->receive_date->format('d-m-Y'): '' }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </table>
        </div>


    </div>





@endsection


