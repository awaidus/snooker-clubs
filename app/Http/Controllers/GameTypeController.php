<?php

namespace App\Http\Controllers;

use App\GameType;
use Illuminate\Http\Request;

class GameTypeController extends Controller
{
    public function index()
    {
        $gameTypes = GameType::with('games')->get();

        return view('game-type.index', compact('gameTypes'));
    }

    public function show($id = null)
    {
        $gameType = (!is_null($id) || $id != -1) ? GameType::find($id) : new GameType();

        return view('game-type.show', compact('gameType'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'game_type' => 'required|unique:game_types,game_type,' . $request->id,
        ]);

        $data = $request->all();

        //dd($data);

        GameType::updateOrCreate(['id' => $data['id']], $data);


        return redirect()->route('home')->with(['success' => 'Game-Type saved successfully !']);
    }
}
