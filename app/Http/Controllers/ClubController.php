<?php

namespace App\Http\Controllers;

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

        $players = Player::with('bills')->get();

        return view('club.index', compact('clubs', 'players'));
    }

    public function show($id = null)
    {
        $club = (!is_null($id) && $id != -1) ? Club::find($id) : new Club();
        $users = User::all()->pluck('first_name', 'id');

        return view('club.show', compact('club', 'users'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'club_name' => 'required|unique:clubs,club_name,' . $request->id,
            'no_of_tables' => 'required',
        ]);


        $data = $request->all();

        //dd($data);

        Club::updateOrCreate(['id' => $data['id']], $data);


        return redirect()->route('home')->with(['success' => 'Club saved successfully !']);
    }

}
