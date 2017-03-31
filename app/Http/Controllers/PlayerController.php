<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Session;

class PlayerController extends Controller
{
    public function index()
    {

        $players = Player::with('sumBills')->get();

        return view('player.index', compact('players'));

    }

    public function show(Request $request, $id = null)
    {
//        dd ($request->all());

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

        return redirect()->back()->with(['success' => "Player <strong> $request->player_name </strong> saved successfully !"]);

    }
}
