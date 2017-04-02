<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Club;
use App\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class BillController extends Controller
{
    public function index()
    {
        $clubs = Club::with('tables.sumBills')->get();

        $bills = Bill::get()->groupBy(function ($item) {
            if (!is_null($item->bill_date))
                return $item->bill_date->format('d-M-y');
        });

        return view('bill.index', compact('bills', 'clubs'));
    }

    public function show($club_id, $game_id, $id = null)
    {

        $game = Game::with('table', 'player', 'game_type')->find($game_id);

        $bill = (!is_null($id) && $id != -1) ? Bill::find($id) : new Bill();

        return view('bill.show', compact('game', 'bill', 'club_id'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'game_id' => 'required',
            'bill' => 'required',

        ]);

        $data = $request->all();

        $data['full_paid'] = $request->has('full_paid');


//        dd($data);


        Bill::updateOrCreate(['id' => $data['id']], $data);


        return redirect()->route('showGames', ['club_id' => $data['club_id']])->with(['success' => 'Bill saved successfully at ' . Carbon::now()]);
    }
}
