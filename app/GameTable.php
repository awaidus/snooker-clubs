<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameTable extends Model
{
    protected $table = 'game_tables';

    protected $fillable = ['club_id', 'table_no'];

    public function club()
    {
        return $this->belongsTo('App\Club');
    }

    public function games()
    {
        return $this->hasMany('App\Game');
    }

    public function bills()
    {
        return $this->hasManyThrough(Bill::class, Game::class);
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Game::class);
    }


    public function sumBills()
    {
        return $this->hasManyThrough(Bill::class, Game::class)
            ->selectRaw('sum(bill) - sum(discount) as total_bills, sum(paid) as total_paid, game_table_id, bill_date')
            ->groupBy('game_table_id')
            ->groupBy('bill_date');
    }

    public function getSumBillsAttribute()
    {
        if (!array_key_exists('sumBills', $this->relations)) $this->load('sumBills');

        return $relation = $this->getRelation('sumBills');

        return ($relation) ? $relation->total_bills : 0;
    }

    public function sumTransaction()
    {
        return $this->hasManyThrough(Bill::class, Game::class)
            ->selecRaw('bills.id, game_id, (bill - discount) as payable, sum(t.amount) as received_amount, receive_date')
            ->leftJoin('transactions t', 'bills.id = t.bill_id')
            ->groupBy('id, game_id, payable, receive_date');
    }

    public function getSumTransactionAttribute()
    {
        if (!array_key_exists('sumTransaction', $this->relations)) $this->load('sumTransaction');

        return $relation = $this->getRelation('sumTransaction');

    }


}
