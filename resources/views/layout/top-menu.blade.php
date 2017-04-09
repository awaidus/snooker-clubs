<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{route('home')}}" class="navbar-brand">
                <i class="fa fa-home fa-lg" aria-hidden="true"></i> Home</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">

                @if(Sentinel::check())
                    <li>
                        <a href="{{route('resetPassword')}}" class="">
                            <i class="fa fa-gear" aria-hidden="true"></i> Settings
                        </a>
                    </li>

                @else
                    <li>
                        <a href="{{route('login')}}">
                            <i class="fa fa-sign-in" aria-hidden="true"></i> Login
                        </a>
                    </li>

                @endif
            </ul>
            {{--<form class="navbar-form navbar-right">--}}
            {{--<input type="text" class="form-control" placeholder="Search...">--}}
            {{--</form>--}}
        </div>
    </div>
</nav>


{{--<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars" aria-hidden="true"></span>
            </button>
            <a href="{{route('home')}}" class="navbar-brand">
                <i class="fa fa-home fa-lg" aria-hidden="true"></i> Snooker-Clubs</a>
        </div> --}}{{--navbar-header--}}{{--

        <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav">
                <li><a href="{{route('showPlayers')}}">Players</a></li>
                <li><a href="{{route('showTransactions')}}">Transactions Summery</a></li>
                <li><a href="{{route('showUsers')}}">Users List</a></li>
            </ul>
            <div class="navbar-form navbar-right">

                @if(Sentinel::check())

                    {!! Form::open(['route' => 'logout']) !!}
                    <button type="submit" class="btn btn-warning"><i class="fa fa-sign-out" aria-hidden="true"></i>
                        Logout, {{ Sentinel::getUser()->first_name }}
                    </button>
                    <a href="{{route('resetPassword')}}" class="btn btn-default">
                        <i class="fa fa-gear" aria-hidden="true"></i>
                    </a>
                    @if(Sentinel::inRole('super') || Sentinel::inRole('admin'))

                        <a href="{{route('showRegistration')}}" class="btn btn-default">
                            <i class="fa fa-user-circle" aria-hidden="true"></i> Add User
                        </a>
                    @endif
                    {!! Form::close() !!}



                @else
                    <a href="{{route('login')}}" class="btn btn-info">
                        <i class="fa fa-sign-in" aria-hidden="true"></i> Login
                    </a>

                @endif

            </div>


        </div><!--/.navbar-collapse -->
    </div>
</nav>--}}


