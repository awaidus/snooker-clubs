<?php

namespace App\Http\Controllers;

use App\Club;
use App\GameTable;
use Illuminate\Http\Request;
use Session;

class GameTableController extends Controller
{
    public function show($club_id, $id = null)
    {
        $table = (!is_null($id) && $id != -1) ? GameTable::find($id) : new GameTable();

        $club = Club::find($club_id);

        return view('game-table.show', compact('table', 'club'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'table_no' => 'required|unique:game_tables',
        ]);

        $data = $request->all();

        GameTable::updateOrCreate(['id' => $data['id']], $data);

        Session::flash('flash_message', 'Saved successfully !');

        return redirect()->route('showGames', ['club_id' => $data['club_id']]);
    }
}
