<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['bill_id', 'user_id', 'player_id', 'game_id', 'amount', 'receive_date'];


    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function getReceiveDateAttribute($value)
    {
        if (!is_null($value)) {
            return Carbon::parse($value);
        }
    }

    public function setReceiveDateAttribute($value)
    {
        if (is_string($value))
            $this->attributes['receive_date'] = Carbon::parse($value);
    }

    public function getCreatedAtAttribute($value)
    {
        if (!is_null($value)) {
            return Carbon::parse($value);
        }
    }

    public function getUpdatedATAttribute($value)
    {
        if (!is_null($value)) {
            return Carbon::parse($value);
        }
    }


    public function scopeSumBillTransaction($query)
    {
        return $query->selectRaw('sum(amount) as total_amount, bill_id')
            ->groupBy('bill_id');
    }

    public function scopeSumDateTransaction($query)
    {
        return $query->selectRaw('sum(amount) as total_amount, receive_date')
            ->groupBy('receive_date');
    }


}
