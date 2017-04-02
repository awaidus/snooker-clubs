<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bill extends Model
{
    protected $fillable = ['game_id', 'bill', 'discount', 'paid', 'bill_date', 'full_paid'];

    //protected $dates = ['bill_date'];

    protected $appends = ['payable', 'balance'];


    public function game()
    {

        return $this->belongsTo(Game::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function sumTransaction()
    {
        return $this->hasMany(Transaction::class)->sumBillTransaction();
    }

    public function getSumTransactionAttribute()
    {
        if (!array_key_exists('sumTransaction', $this->relations)) $this->load('sumTransaction');

        return $relation = $this->getRelation('sumTransaction');

    }

    public function scopeTotalTransaction($query)
    {
        return $query->select(DB::raw('bills.*, SUM(amount) AS total_received_amount, receive_date'))
            ->leftJoin('transactions', 'bills.id', 'transactions.bill_id')
            ->groupBy('id')
            ->groupBy('game_id')
            ->groupBy('bill')
            ->groupBy('receive_date');
    }


    public function getPayableAttribute()
    {
        if (!is_null($this->attributes['bill']))
            return $this->attributes['payable'] = $this->attributes['bill'] - $this->attributes['discount'];
    }

    public function getBalanceAttribute()
    {
        if (!is_null($this->attributes['payable']))

            return $this->attributes['balance'] = $this->attributes['payable'] - $this->attributes['paid'];
    }

    public function getBillDateAttribute($value)
    {
        if (!is_null($value)) {
//            return Carbon::createFromFormat('Y-m-d', $value);
            return Carbon::parse($value);
        }
    }

    public function getReceiveDateAttribute($value)
    {
        if (!is_null($value)) {
            return Carbon::parse($value);
        }
    }

    public function setBillDateAttribute($value)
    {
        if (is_string($value))
            $this->attributes['bill_date'] = Carbon::parse($value);
    }

    public function getFullPaidAttribute($value)
    {
        return (bool)$value;
    }

    public function setFullPaidAttribute($value)
    {
        $this->attributes['full_paid'] = (bool)$value;
    }

}
