<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['bill_id', 'user_id', 'player_id', 'amount', 'receive_date'];


    public function game()
    {
        return $this->belongsTo(Bill::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }


}
