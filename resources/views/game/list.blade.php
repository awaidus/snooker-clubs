@extends('layout.master')

@section('content')

    <div class="row">
        <div class="col-md-9">
            <a href="{{ route('showGames', ['club_id'=> session('club_id')]) }}"
               class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back to Game Hall
            </a>

        </div>
    </div>

    <br>

    <table class="table table-bordered table-hover table-condensed" id="playerTable">
        <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Table</th>
            <th>Game Type</th>
            <th>Started At</th>
            <th>Ended At</th>
            <th>Bill</th>
            <th>Payment</th>
            <th></th>
        </tr>
        </thead>
    </table>

    {{--<games-list club-id="{{session('club_id')}}">--}}
    {{--<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>--}}
    {{--<span class="sr-only">Loading...</span>--}}
    {{--</games-list>--}}

@endsection


@section('script')
    <script>

        var t = $('#playerTable').DataTable({
            processing: true,
            //serverSide: true,
            ajax: '{!! route('api.getGamesList', ['club_id' => session('club_id')]) !!}',
//            ajax: '/api/players/' + global.clubId,
            columns: [
//                {
//                    data: 'DT_Row_Index', name: 'DT_Row_Index',
//                    "searchable": false, "orderable": false, "targets": 0
//                },
                {
                    data: 'DT_Row_Index', name: 'DT_Row_Index',
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                },
                {data: 'working_day', name: 'working_day'},
                {data: 'table_no', name: 'table_no'},
                {data: 'game_type', name: 'game_type'},
                {data: 'started_at', name: 'started_at'},
                {data: 'ended_at', name: 'ended_at'},
                {data: 'total_bill', name: 'total_bill'},
                {data: 'total_payments', name: 'total_payments'},
                {
                    name: 'actions',
                    data: null,
                    sortable: false,
                    searchable: false,
                    render: function (data) {
                        var actions = '';
                        actions += '<a href="{{route('showGame', ['id' => ':id'])}}" class="btn btn-default"><i class="fa fa-edit"></></a>';
                        {{--actions += '<a href="{{ route('destroyPlayer/', ':id') }}">Delete</a>';--}}
                            return actions.replace(/:id/g, data.id);
                    }
                }
            ],
            order: [[1, 'desc']]
        });


        t.on('order.dt search.dt', function () {
            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

    </script>
@endsection