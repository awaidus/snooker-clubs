<?php

namespace App\Http\Controllers;

use App\Club;
use App\Transaction;
use Illuminate\Http\Request;
use Sentinel;

class TransactionController extends Controller
{
    public function index()
    {
//        return $club->map(function($club){
//            return $club->transactions->groupBy(function ($item) {
//                if (!is_null($item->created_at))
//                    return $item->created_at->format('d-M-y');
//            });
//        });

        if (Sentinel::inRole('manager')) {

            $clubs_collection = Club::forManager()->with('transactions')->get();

            $clubs = $clubs_collection->groupBy('club_name')->map(function ($clubName) {
                return $clubName->map(function ($club) {
                    return $club->transactions->groupBy(function ($item) {
                        if (!is_null($item->created_at))
                            return $item->created_at->format('d-M-y');
                    });
                });
            });

//            $club = Club::forManager()->first();
//
//            $transactions = $club->transactions->groupBy(function ($item) {
//                if (!is_null($item->created_at))
//                    return $item->created_at->format('d-M-y');
//            });

        } elseif (Sentinel::inRole('admin') || Sentinel::inRole('super')) {

            $clubs_collection = Club::with('transactions')->get();

            $clubs = $clubs_collection->groupBy('club_name')->map(function ($clubName) {
                return $clubName->map(function ($club) {
                    return $club->transactions->groupBy(function ($item) {
                        if (!is_null($item->created_at))
                            return $item->created_at->format('d-M-y');
                    });
                });
            });


        } else {

            return redirect()->back()
                ->with(['error' => 'You do not have permission to access.']);

        }


//        $games = $transactions->where('amount' , '<', 0)->groupBy(function ($item) {
//            if (!is_null($item->created_at))
//                return $item->created_at->format('d-M-y');
//        });
//
//        $payments = $transactions->where('amount' , '>', 0)->groupBy(function ($item) {
//            if (!is_null($item->created_at))
//                return $item->created_at->format('d-M-y');
//        });

        return view('transaction.index', compact('clubs'));

    }

    public function show($id = null)
    {
        $transaction = (!is_null($id) || $id != -1) ? Transaction::find($id) : new Transaction();

        return view('transaction.show', compact('transaction'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'receive_date' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Sentinel::getUser()->id;

//        dd($data);

        $transaction = Transaction::updateOrCreate(['id' => $data['id']], $data);

        return redirect()->route('showGames', ['club_id' => session('club_id')])
            ->with(['success' => 'Transaction saved successfully !']);

    }

    public function storeUserShare(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
        ]);

        $data = $request->all();
        $data['amount'] = -$request->amount;
        $data['user_id'] = Sentinel::getUser()->id;

//        dd($data);

//        Transaction::where('id', $data['id'])->update($data);

        Transaction::updateOrCreate(['id' => $data['id']], $data);

        return redirect()->route('showGame', ['id' => $data['game_id']])
            ->with(['success' => 'Player\'s Share in game is saved successfully !']);

    }
}
