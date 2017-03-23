<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Club;
use App\Player;
use Illuminate\Http\Request;
use Session;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::all();
        $bills = Bill::all();
        $players = Player::with('bills')->get();

        return view('club.index', compact('clubs', 'bills', 'players'));
    }

    public function show($id = null)
    {
        $club = (!is_null($id) && $id != -1) ? Club::find($id) : new Club();

        return view('club.show', compact('club'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'club_name' => 'required|unique:clubs',
            'no_of_tables' => 'required',
        ]);

        $data = $request->all();

        Club::updateOrCreate(['id' => $data['id']], $data);

        Session::flash('flash_message', 'Club saved successfully !');

        return redirect()->route('home');
    }

}
