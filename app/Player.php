<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['player_name', 'contact', 'club_id'];

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function bills()
    {
        return $this->hasManyThrough(Bill::class, Game::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function sumBills()
    {
        return $this->hasManyThrough(Bill::class, Game::class)
            ->selectRaw('sum(paid) as total_paid, SUM(bill) - - sum(discount) - SUM(paid) AS total_balance, player_id')
            ->groupBy('player_id');
    }

    public function getSumBillsAttribute()
    {
        if (!array_key_exists('sumBills', $this->relations)) $this->load('sumBills');

        return $relation = $this->getRelation('sumBills');

        return ($relation) ? $relation->total_bills : 0;
    }


}
