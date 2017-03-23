@extends('layout.master')

@section('content')
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="{{route('showOrder', ['id' => $order->id ])}}">Supply Order</a>
            </li>
            <li role="presentation">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false">Payments<span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li><a href="{{route('showPayment', ['order'=> $order, 'payment' => null, 'id'=>null ])}}">New
                            Payment</a></li>
                    <li role="separator" class="divider"></li>

                    @foreach($order->payments as $payment)
                        <li>
                            <a href="{{route('showPayment', ['order'=> $order, 'payment' => $payment, 'id' => $payment->id ])}}">
                                {{ $payment->release_date }}</a>
                        </li>
                    @endforeach

                </ul>

            </li>
            <li role="presentation">
                <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Shipments</a>
            </li>
            {{--<li role="presentation">--}}
            {{--<a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">To-Dos</a>--}}
            {{--</li>--}}
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            @yield('tab-content')

            {{--<div role="tabpanel" class="tab-pane active" id="home">...</div>--}}
            {{--<div role="tabpanel" class="tab-pane" id="profile">...</div>--}}
            {{--<div role="tabpanel" class="tab-pane" id="messages">...</div>--}}
            {{--<div role="tabpanel" class="tab-pane" id="settings">...</div>--}}
        </div>

    </div>

@endsection
