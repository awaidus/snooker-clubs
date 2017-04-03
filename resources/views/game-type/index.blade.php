@extends('layout.master')

@section('content')
    <div>
        <h2>Game Types List</h2>

        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('showGameType', ['id'=> null]) }}"
                   class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> New Game Type
                </a>
            </div>
        </div>

        </br>
        @foreach($gameTypes as $type)

            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h3>{{ $type->game_type }}</h3></div>
                    <a href="{{ route('showGameType', ['id'=> $type->id]) }}"
                       class="btn btn-default btn-block"><i class="fa fa-edit fa-2x" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

        @endforeach

    </div>
@endsection

