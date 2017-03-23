<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars" aria-hidden="true"></span>
            </button>
            <a href="{{route('home')}}" class="navbar-brand">
                <i class="fa fa-home fa-lg" aria-hidden="true"></i> Snooker-Clubs</a>
        </div> {{--navbar-header--}}

        <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav">
                <li><a href="{{route('showPlayers')}}">Clients/Players</a></li>
                <li><a href="{{route('showBills')}}">Bills Summery</a></li>
            </ul>
            <div class="navbar-form navbar-right">

                @if(Sentinel::check())

                    {!! Form::open(['route' => 'logout']) !!}
                    <button type="submit" class="btn btn-warning"><i class="fa fa-sign-out" aria-hidden="true"></i>
                        Logout, {{ Sentinel::getUser()->first_name }}
                    </button>

                    {!! Form::close() !!}

                @else
                    <a href="{{route('login')}}" class="btn btn-info">
                        <i class="fa fa-sign-in" aria-hidden="true"></i> Login
                    </a>
                    @if(Sentinel::check() && (Sentinel::inRole('super') || Sentinel::inRole('admin')))

                        <a href="{{route('showRegistration')}}" class="btn btn-default">
                            <i class="fa fa-id-card" aria-hidden="true"></i> Register
                        </a>
                    @endif

                @endif

            </div>


        </div><!--/.navbar-collapse -->
    </div>
</nav>