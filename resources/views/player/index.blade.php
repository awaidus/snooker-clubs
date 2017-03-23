@extends('layout.master')

@section('content')
    <div>
        <h2>Players List</h2>

        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
            @endif

            </br>

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

                    <th></th>
                </tr>
                @foreach($players as $player)
                    <tr>
                        <td>
                            <div>{{ $player->player_name}}</div>
                        </td>
                        <td>
                            {{ $player->contact }}
                        </td>
                        <td>
                            <a href="{{ route('showPlayer', ['id'=> $player->id]) }}"
                               class="btn btn-default"><i class="fa fa-edit" aria-hidden="true"></i> Open
                            </a>
                        </td>
                    </tr>
                @endforeach

            </table>

    </div>
@endsection

