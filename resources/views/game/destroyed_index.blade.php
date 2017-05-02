@extends('layout.master')

@section('content')

    <h1>Deleted Games
        <small> for {{session('club.club_name')}}</small>
    </h1>

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
            <th>Type</th>
            <th>Started At</th>
            <th>Ended At</th>
            <th>Bill</th>
            <th>Payment</th>
            <th>Deleted At</th>
            <th></th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Table</th>
            <th>Type</th>
            <th>Started At</th>
            <th>Ended At</th>
            <th>Bill</th>
            <th>Payment</th>
            <th>Deleted At</th>
            <th></th>
        </tr>
        </tfoot>

    </table>

@endsection



@section('script')
    <script>

        //1. Setup - add a text input to each footer cell
        $('#playerTable tfoot th')
            .not(":eq(0),:eq(9)")
            .each(function () {
                var title = $('#playerTable thead th').eq($(this).index()).text();
                //var title = $(this).text();
//                $(this).html('<input type="text" class="" placeholder="Search ' + title + '" />');
                $(this).html('<input type="text" class="" />');
            });

        var table = $('#playerTable').DataTable({
            processing: true,
            //serverSide: true,
            ajax: '{!! route('api.getDestroyedGames', ['club_id' => session('club_id')]) !!}',
            columns: [
                {
                    data: 'DT_Row_Index', name: 'DT_Row_Index',
                    "searchable": false,
                    "orderable": false,
                    "targets": 0,
                },
                {data: 'working_day', name: 'working_day', "width": "10%"},
                {data: 'table_no', name: 'table_no', "width": "7%"},
                {data: 'game_type', name: 'game_type', "width": "7%"},
                {data: 'started_at', name: 'started_at'},
                {data: 'ended_at', name: 'ended_at'},
                {data: 'total_bill', name: 'total_bill', "width": "7%"},
                {data: 'total_payments', name: 'total_payments', "width": "7%"},
                {data: 'deleted_at', name: 'deleted', "width": "15%"},
                {
                    name: 'actions',
                    data: null,
                    sortable: false,
                    searchable: false,
                    render: function (data) {
                        var actions = '';
                        actions += '<a href="{{route('showGame', ['id' => ':id'])}}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>';
                        actions += '<a href="{{ route('restoreGame', ':id') }}" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>';
                        return actions.replace(/:id/g, data.id);
                    }
                }
            ],
            order: [[1, 'desc']]
        });


        //2. Apply the search
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });


        //For row numbering
        table.on('order.dt search.dt', function () {
            table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

    </script>
@endsection