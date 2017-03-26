@extends('layout.master')

@section('content')
</br>

<div>

    <h1>User List </h1>

    <table class="table table-bordered table-hover">
        <tr class="default">
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Permissions</th>
            <th>Roles</th>
            <th>Last Login</th>
            <th></th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->first_name}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @foreach($user->permissions as $permission)
                        <li>{{$permission}}</li>
                    @endforeach
                </td>
                <td>
                    @foreach($user->roles as $role)
                        <li>{{$role->name}}</li>
                    @endforeach
                </td>
                <td>{{$user->last_login}}</td>
                <td>
                    <a href="{{ route('showRegistration', ['user_id'=> $user->id, 'club_id' => Session::get('club_id')] ) }}"
                       class="btn btn-default"><i class="fa fa-edit" aria-hidden="true"></i> Open
                    </a>
                </td>
            </tr>
        @endforeach

    </table>


</div>
@endsection

