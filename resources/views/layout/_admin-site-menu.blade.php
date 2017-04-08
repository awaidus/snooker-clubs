<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
        <li><a href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
        <li><a href="{{route('showUsers')}}"><i class="fa fa-users" aria-hidden="true"></i> Users List</a></li>
        @if(Sentinel::inRole('super') || Sentinel::inRole('admin'))
            <li>
                <a href="{{route('showRegistration')}}" class="">
                    <i class="fa fa-user" aria-hidden="true"></i> Add User
                </a>
            </li>
        @endif
    </ul>
    @if(Sentinel::inRole('super') || Sentinel::inRole('admin'))
        <ul class="nav nav-sidebar">
            <li><a href="{{route('showClub')}}"><i class="fa fa-plus" aria-hidden="true"></i> New Club</a></li>
            <li><a href="{{route('showGameTypes')}}"><i class="fa fa-list-ul" aria-hidden="true"></i> Game Types</a>
            </li>
        </ul>
    @endif
    {{--<ul class="nav nav-sidebar">--}}
    {{--<li><a href="">Nav item again</a></li>--}}
    {{--<li><a href="">One more nav</a></li>--}}
    {{--<li><a href="">Another nav item</a></li>--}}
    {{--</ul>--}}
</div>