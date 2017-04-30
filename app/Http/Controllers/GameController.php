<?php

namespace App\Http\Controllers;

use App\Club;
use App\Game;
use App\GameTable;
use App\GameType;
use App\Player;
use Carbon\Carbon;
use Datatables;
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

        $club = Club::find($club_id);

//        $bills = [];
//        $totals['today'] = 0;
//        $totals['discountToday'] = 0;
//        $totals['thisMonth'] = 0;
//        $totals['discountThisMonth'] = 0;
//
//        foreach ($club->tables as $table) {
//
//            $bills[$table->table_no]['today']['bill'] = $table->games->filter(function ($item, $key) {
//                return $item->started_at->isToday();
//            })->sum('bill');
//            $totals['today'] = $totals['today'] + $bills[$table->table_no]['today']['bill'];
//
//
//            $bills[$table->table_no]['today']['discount'] = $table->games->filter(function ($item, $key) {
//                return $item->started_at->isToday();
//            })->sum('discount');
//            $totals['discountToday'] = $totals['discountToday'] + $bills[$table->table_no]['today']['discount'];
//
//
//            $bills[$table->table_no]['thisMonth']['bill'] = $table->games->filter(function ($item, $key) {
//                return $item->started_at->month == \Carbon\Carbon::now()->month;
//            })->sum('bill');
//            $totals['thisMonth'] = $totals['thisMonth'] + $bills[$table->table_no]['thisMonth']['bill'];
//
//
//            $bills[$table->table_no]['thisMonth']['discount'] = $table->games->filter(function ($item, $key) {
//                return $item->started_at->month == \Carbon\Carbon::now()->month;
//            })->sum('discount');
//            $totals['discountThisMonth'] = $totals['discountThisMonth'] + $bills[$table->table_no]['thisMonth']['discount'];
//
//
//        };
//          $players = Player::with('transactions')->where('club_id', session('club_id'))->get();

        return view('game.index', compact('club'));

    }


    public function show($id = null)
    {
        $game = (!is_null($id) || $id != -1) ? Game::with(['players.transactions' => function ($query) use ($id) {

            $query->where('game_id', $id);

        }])->find($id) : new Game();

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
            'working_day' => 'required',
            'game_table_id' => 'required',
            'game_type_id' => 'required',
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

        $game->players()->sync((array)$request->player_ids);

        //Transaction::where('game_id', $game->id)->delete();
//        foreach ($game->players as $player) {
//
//            $data['game_id'] = $game->id;
//            $data['player_id'] = $player->id;
//            $data['user_id'] = Sentinel::getUser()->id;
//            $data['amount'] = -($game->bill - $game->discount) / $game->players->count('id');
//
//            Transaction::create($data);
//        }


        //Game::updateOrCreate(['id' => $data['id']], $data);


        return redirect()->route('showGames', ['club_id' => session('club_id')])
            ->with(['success' => 'Game saved successfully !']);

    }

    public function destroy($id)
    {
        Game::where('id', $id)->delete();

        return response()->json('Game is deleted.');
    }


    public function restore($id)
    {
        Game::where('id', $id)->restore();

        return response()->json('Game is restored.');
    }


    public function games()
    {
        return view('game.list');
    }


    public function getGamesList($club_id)
    {
        /*$club = Club::with(['games' => function ($query) {

            $query->withTotalPayments();

        }, 'games.type',

            'games.table' => function ($query) {

                $query->orderBy('table_no', 'ASC');
            },

            'games.players' => function ($query) {

                $query->withTrashed();

            }])->find($club_id);*/


        $games = Game::withDetails()
            ->withTotalPayments()
            ->where('game_tables.club_id', $club_id)
            ->orderBy('games.working_day', 'desc')
            ->get();

        //return response()->json($games);


        return Datatables::of($games)
            ->addIndexColumn()
            ->editColumn('working_day', function ($game) {
                return $game->working_day ? with(new Carbon($game->working_day))->format('d-m-Y') : '';
            })
            ->editColumn('started_at', function ($game) {
                return $game->started_at ? with(new Carbon($game->started_at))->format('d-m-Y @g:i A') : '';
            })
            ->editColumn('ended_at', function ($game) {
                return $game->ended_at ? with(new Carbon($game->ended_at))->format('d-m-Y @g:i A') : '';
            })
            ->filterColumn('working_day', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->filterColumn('started_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->filterColumn('ended_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->make(true);
    }

    public function getGames($club_id)
    {
        /*$club_id = session('club_id') ;

        $club_id = (!is_null(request('club_id'))
            ? request('club_id')
            : session('club_id') || request()->route('club_id'));*/


        $active_games = Club::with(['tables.games' => function ($query) {

            $query->withTotalPayments()->active();

        },
            'tables.games.type',

            'tables.games.players' => function ($query) {

                $query->withTrashed();

            }])->find($club_id);


        $payments_games = Club::with(['tables.games' => function ($query) {

            $query->withTotalPayments()->having('total_bill', '>', 'total_payments');

        },
            'tables.games.type',

            'tables.games.players' => function ($query) {

                $query->withTrashed();

            }])->find($club_id);


//        $payments_games = Game::withDetails()
//            ->withTotalPayments()
//            ->where('game_tables.club_id', $club_id)
//            ->having('total_bill', '>', 'total_payments')
//            ->get();
//
//        $active_games = Game::withDetails()
//            ->withTotalPayments()
//            ->active()
//            ->where('game_tables.club_id', $club_id)
//            ->get();

        return response()->json(['clubWithActiveGames' => $active_games, 'clubWithPendingPayments' => $payments_games,]);

    }

}
