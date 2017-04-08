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
        if (Sentinel::inRole('manager')) {

            $club = Club::forManager()->first();

            $transactions = $club->transactions->groupBy(function ($item) {
                if (!is_null($item->created_at))
                    return $item->created_at->format('d-M-y');
            });

        } elseif (Sentinel::inRole('admin') || Sentinel::inRole('super')) {

            $transactions = Transaction::all()->groupBy(function ($item) {
                if (!is_null($item->created_at))
                    return $item->created_at->format('d-M-y');
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

        return view('transaction.index', compact('transactions'));

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

        return redirect()->route('showPlayerTransaction', ['id' => $transaction->player_id])
            ->with(['success' => 'Transaction saved successfully !']);

    }
}
