<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        Sentinel::forceAuthenticate($request->all());

        //Session::flash('flash_message', 'User logged in!');

        return redirect()->route('home')->withSuccess('Login successfully.');;

    }

    public function logout(Request $request)
    {
        Sentinel::logout();

        return redirect()->route('login');

    }


}
