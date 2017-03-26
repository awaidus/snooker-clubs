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
        if (Sentinel::authenticate($request->all())) {

            return redirect()->route('home');
        }

        return redirect()->route('login')->with(['error' => 'Username or password is incorrect.']);;

    }

    public function logout(Request $request)
    {
        Sentinel::logout();

        return redirect()->route('login');

    }


}
