<?php

namespace App\Http\Controllers;

use App\Club;
use App\Game;
use App\GameTable;
use App\GameType;
use App\Player;
use App\Transaction;
use Illuminate\Http\Request;
use JavaScript;
use Sentinel;
use Session;


class GameController extends Controller
{
    public function index($club_id)
    {
        Session::put('club_id', $club_id);

        JavaScript::put([
            'global' =>
                ['clubId' => session('club_id')],
        ]);

//        $club = Club::with(['tables.games' => function ($query) {
//            $query->active();
//
//        }, 'players.transactions'])->find($club_id);

        $club = Club::with(['tables.games', 'tables.games.player' => function ($query) {
            $query->withTrashed();
        }, 'players' => function ($query) {
            $query->withTrashed();
        }, 'players.transactions'])->find($club_id);

        $bills = [];
        $totals['today'] = 0;
        $totals['discountToday'] = 0;
        $totals['thisMonth'] = 0;
        $totals['discountThisMonth'] = 0;

        foreach ($club->tables as $table) {

            $bills[$table->table_no]['today']['bill'] = $table->games->filter(function ($item, $key) {
                return $item->started_at->isToday();
            })->sum('bill');
            $totals['today'] = $totals['today'] + $bills[$table->table_no]['today']['bill'];


            $bills[$table->table_no]['today']['discount'] = $table->games->filter(function ($item, $key) {
                return $item->started_at->isToday();
            })->sum('discount');
            $totals['discountToday'] = $totals['discountToday'] + $bills[$table->table_no]['today']['discount'];


            $bills[$table->table_no]['thisMonth']['bill'] = $table->games->filter(function ($item, $key) {
                return $item->started_at->month == \Carbon\Carbon::now()->month;
            })->sum('bill');
            $totals['thisMonth'] = $totals['thisMonth'] + $bills[$table->table_no]['thisMonth']['bill'];


            $bills[$table->table_no]['thisMonth']['discount'] = $table->games->filter(function ($item, $key) {
                return $item->started_at->month == \Carbon\Carbon::now()->month;
            })->sum('discount');
            $totals['discountThisMonth'] = $totals['discountThisMonth'] + $bills[$table->table_no]['thisMonth']['discount'];


        };


        $players = Player::with('transactions')->where('club_id', session('club_id'))->get();

        return view('game.index', compact('club', 'players', 'bills', 'totals'));

    }

    public function games()
    {


//        $club = Club::with(['tables.games' => function ($query) {
//            $query->active();
//
//        }, 'players.transactions'])->find($club_id);
        JavaScript::put([
            'global' =>
                ['clubId' => session('club_id')],
        ]);

        //$club = Club::find(session('club_id'))->with('games.players', 'games.table')->first();

        return view('game.list', compact('club'));

    }


    public function show($id = null)
    {
        $game = (!is_null($id) || $id != -1) ? Game::with('table', 'players')->find($id) : new Game();

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

//        dd($request->all());

        $this->validate($request, [
            'game_table_id' => 'required',
            'game_type_id' => 'required',
            'player_ids' => 'required',
            'bill' => 'required|integer|min:10',
            'started_at' => 'required',
        ]);

        $data = $request->all();

        //$data['completed'] = $request->has('completed');
        $data['player_id'] = -1;
        $data['user_id'] = Sentinel::getUser()->id;

        //dd($data);


        if (!is_null($request->id)) {

            $game = Game::find($request->id);

//            foreach ($game->players as $player) {
//
//                $where = ['player_id' => $player->id, 'game_id' => $game->id];
//
//                //Transaction::create($data);return
//            }

            $game->update($data);


            //event(new GameUpdated($game));


        } else {

            $game = Game::create($data);
        }

        $game->players()->sync($request->player_ids);

        Transaction::where('game_id', $game->id)->delete();

        foreach ($game->players as $player) {

            $data['game_id'] = $game->id;
            $data['player_id'] = $player->id;
            $data['user_id'] = Sentinel::getUser()->id;
            $data['amount'] = -($game->bill - $game->discount) / $game->players->count('id');

            Transaction::create($data);
        }


        //Game::updateOrCreate(['id' => $data['id']], $data);


        return redirect()->route('showGames', ['club_id' => session('club_id')])
            ->with(['success' => 'Game saved successfully !']);

    }

    public function destroy($id)
    {
        Game::where('id', $id)->delete();

        return redirect()->back()->with(['success' => 'Game is deleted.']);
    }


    public function restore($id)
    {
        Game::where('id', $id)->restore();

        return redirect()->back()->with(['success' => 'Game is restored.']);
    }
}
