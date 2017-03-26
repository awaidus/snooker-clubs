<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Club;
use App\Player;
use App\User;
use Illuminate\Http\Request;
use Session;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::with('tables.bills')->get();

        $bills = Bill::all();

        $players = Player::with('bills')->get();

        return view('club.index', compact('clubs', 'bills', 'players'));
    }

    public function show($id = null)
    {
        $club = (!is_null($id) && $id != -1) ? Club::find($id) : new Club();
        $users = User::all()->pluck('first_name', 'id');

        return view('club.show', compact('club', 'users'));
    }

    public function store(Request $request)
    {
        if ($request->id) {

        } else {


        }

        $this->validate($request, [
            'club_name' => 'required|unique:clubs,club_name,' . $request->id,
            'no_of_tables' => 'required',
        ]);


        $data = $request->all();

        //dd($data);

        Club::updateOrCreate(['id' => $data['id']], $data);

        Session::flash('flash_message', 'Club saved successfully !');

        return redirect()->route('home');
    }

}
