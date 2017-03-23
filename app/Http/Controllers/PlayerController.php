<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Session;

class PlayerController extends Controller
{
    public function index()
    {

        $players = Player::all();

        return view('player.index', compact('players'));

    }

    public function show($id = null)
    {
        $player = (!is_null($id) && $id != -1) ? Player::find($id) : new Player();

        return view('player.show', compact('player'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'player_name' => 'required',
        ]);

        $data = $request->all();

//        dd($data);


        Player::updateOrCreate(['id' => $data['id']], $data);

        Session::flash('flash_message', 'Player saved successfully ');

        return redirect()->route('showPlayers');

    }
}
