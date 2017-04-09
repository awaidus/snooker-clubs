<?php

namespace App\Http\Controllers;

use App\Club;
use App\Player;
use App\Transaction;
use Illuminate\Http\Request;
use Session;

class PlayerController extends Controller
{
    public function index()
    {

        //$players = Player::where('club_id', session('club_id'))->with('transactions')->get();

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

    public function showPlayerTransaction($id, $transaction_id = null)
    {
        $player = Player::with(['transactions' => function ($item) {
            return $item->orderBy('receive_date', 'desc');
        }, 'transactions.game.game_type'])->find($id);

        $transaction = (!is_null($transaction_id)) ? Transaction::find($transaction_id) : new Transaction();

        return view('player.showPlayerTransaction', compact('player', 'transaction'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'player_name' => 'required',
        ]);

        $data = $request->all();
        $data['club_id'] = session('club_id');

        //dd($data);


        Player::updateOrCreate(['id' => $data['id']], $data);

        return redirect()->back()->with(['success' => "Player <strong> $request->player_name </strong> saved successfully !"]);

    }

    public function destroy($id)
    {
        Player::find($id)->delete();

//        return redirect()->back()->with(['success' => 'Player is deleted.']);
        return response()->json(['success' => 'Player is deleted.']);
    }


    public function restore($id)
    {
        Player::find($id)->restore();

        return response()->json(['success' => 'Player is restored.']);

//        return redirect()->back()->with(['success' => 'Player is deleted.']);
    }
}
