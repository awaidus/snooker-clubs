<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Sentinel;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::get();

        return view('game.index', compact('transactions'));

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
