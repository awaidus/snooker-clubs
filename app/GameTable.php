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



}
