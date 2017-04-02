<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Sentinel;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return view('user.index', compact('users'));

    }

    public function showRegistration()
    {
        $roles = Sentinel::getRoleRepository()->where('slug', '!=', 'super')->get()->pluck('name', 'id');

        $id = request('user_id');

        $user = Sentinel::findById($id);

        $roles = Sentinel::getRoleRepository()->where('slug', '!=', 'super')->get()->pluck('name', 'id');;

        return view('auth.register', compact('roles', 'user'));
    }

    public function storeUser(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);


        $user = Sentinel::registerAndActivate($request->all());

        $role = Sentinel::findRoleById($request->role_id);

        $role->users()->attach($user);


        return redirect()->route('home')->with(['success' => 'User registered successfully !']);

    }

    public function editUser(Request $request)
    {

    }

}
