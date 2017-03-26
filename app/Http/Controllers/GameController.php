<?php

namespace App\Http\Controllers;

use App\Club;
use App\Game;
use App\GameTable;
use App\GameType;
use App\Player;
use Illuminate\Http\Request;
use Sentinel;
use Session;

class GameController extends Controller
{
    public function index($club_id)
    {
        Session::put('club_id', $club_id);

        $club = Club::with(['tables.games' => function ($query) {
            $query->whereCompleted(false);

        }, 'tables.games.bill'])->find($club_id);

        //$club = Club::with('tables')->find($club_id);

        return view('game.index', compact('club'));

    }

    public function show($club_id, $id = null)
    {
//        dd( request()->get('table_id') );

        $game = (!is_null($id) || $id != -1) ? Game::with('table', 'player', 'bill')->find($id) : new Game();

//        $game = Game::with('table', 'player')->find($id) ;

        $game_types = GameType::all()->pluck('game_type', 'id');
        $players = Player::all()->pluck('player_name', 'id');
        $game_table = GameTable::where('club_id', $club_id)->pluck('table_no', 'id');


        return view('game.show', compact('game', 'game_types', 'game_table', 'players', 'club_id'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'game_table_id' => 'required',
            'game_type_id' => 'required',
            'player_id' => 'required',
        ]);

        $data = $request->all();

        $data['completed'] = $request->has('completed');
        $data['user_id'] = Sentinel::getUser()->id;

//        dd($data);

        Game::updateOrCreate(['id' => $data['id']], $data);


        Session::flash('flash_message', 'Saved successfully !');

        return redirect()->route('showGames', ['club_id' => $data['club_id']]);

    }

    public function destroy($id)
    {
        $deletedRows = Game::where('id', $id)->delete();

        Session::flash('flash_message', 'Soft-Delete successfully !');

        return redirect()->route('home');
    }


    public function restore($id)
    {
        Game::where('id', $id)->restore();

        Session::flash('flash_message', 'Restore successfully !');

        return redirect()->route('home');
    }
}
