<?php

namespace App\Http\Controllers;

use App\Club;
use App\Player;
use Illuminate\Http\Request;
use Session;

class PlayerController extends Controller
{
    public function index()
    {

        $players = Player::with('transactions')->get();

        return view('player.index', compact('players'));

    }

    public function show($id = null)
    {
        $player = (!is_null($id) && $id != -1)
            ? Player::with(['transactions' => function ($item) {
                return $item->orderBy('receive_date', 'desc');
            }])->find($id)
            : new Player();

        $clubs = Club::all()->pluck('club_name', 'id');

        return view('player.show', compact('player', 'clubs'));
    }

    public function showPlayerTransaction($id)
    {
        $player = Player::with(['transactions' => function ($item) {
            return $item->orderBy('receive_date', 'desc');
        }, 'transactions.game.game_type'])->find($id);


        return view('player.showPlayerTransaction', compact('player'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'player_name' => 'required',
        ]);

        $data = $request->all();
        $data['club_id'] = session('club_id');

//        dd($data);


        Player::updateOrCreate(['id' => $data['id']], $data);

        return redirect()->back()->with(['success' => "Player <strong> $request->player_name </strong> saved successfully !"]);

    }
}
