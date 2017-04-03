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

        return redirect()->route('login')->with(['error' => 'Username or password is incorrect.']);

    }

    public function logout()
    {
        Sentinel::logout();

        return redirect()->route('login');

    }

    public function resetPassword()
    {

        return view('auth.resetPassword');
    }

    public function storeResetPassword(Request $request)
    {

        $hasher = Sentinel::getHasher();

        $oldPassword = $request->old_password;
        $password = $request->password;
        $passwordConf = $request->password_confirmation;

        $user = Sentinel::getUser();

        if (!$hasher->check($oldPassword, $user->password) || $password != $passwordConf) {
            Session::flash('error', 'Input password is correct.');
            return view('auth.resetPassword');
        }

        Sentinel::update($user, array('password' => $password));

        return redirect()->route('home')->with(['success' => 'Password has successfully been changed.']);
    }


}
