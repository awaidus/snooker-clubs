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

//        $club = Club::with(['tables.games' => function ($query) {
//            $query->active();
//
//        }, 'players.transactions'])->find($club_id);

        $club = Club::with(['tables.games', 'players.transactions'])->find($club_id);

        $bills = [];
        $totals['today'] = 0;
        $totals['thisMonth'] = 0;

        foreach ($club->tables as $table) {
            $bills[$table->table_no]['today']['bill'] = $table->games->filter(function ($item, $key) {
                return $item->started_at->isToday();
            })->sum('bill');

            $totals['today'] = $totals['today'] + $bills[$table->table_no]['today']['bill'];

            $bills[$table->table_no]['today']['discount'] = $table->games->filter(function ($item, $key) {
                return $item->started_at->isToday();
            })->sum('discount');

            $bills[$table->table_no]['thisMonth'] = $table->games->filter(function ($item, $key) {
                return $item->started_at->month == \Carbon\Carbon::now()->month;
            })->sum('bill');

            $totals['thisMonth'] = $totals['thisMonth'] + $bills[$table->table_no]['thisMonth'];
        };


        $players = Player::with('transactions')->where('club_id', session('club_id'))->get();

        return view('game.index', compact('club', 'players', 'bills', 'totals'));

    }

    public function show($id = null)
    {
        $game = (!is_null($id) || $id != -1) ? Game::with('table', 'player')->find($id) : new Game();

//        $table = GameTable::with(['games' => function ($query) {
//            $query->active();
//        }])->where('club_id', session('club_id'))->find($table_id);


        $game_types = GameType::all()->pluck('game_type', 'id');
        $players = Player::where('club_id', session('club_id'))->get()->pluck('player_name', 'id');
        $game_tables = GameTable::where('club_id', session('club_id'))->pluck('table_no', 'id');

        return view('game.show', compact('game', 'game_types', 'game_tables', 'players'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'game_table_id' => 'required',
            'game_type_id' => 'required',
            'player_id' => 'required',
            'bill' => 'required|integer|min:10',
            'started_at' => 'required',
        ]);

        $data = $request->all();

        //$data['completed'] = $request->has('completed');
        $data['user_id'] = Sentinel::getUser()->id;

//        dd($data);

        Game::updateOrCreate(['id' => $data['id']], $data);

        return redirect()->route('showGames', ['club_id' => session('club_id')])
            ->with(['success' => 'Game saved successfully !']);

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
