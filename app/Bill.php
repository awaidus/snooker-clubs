<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['game_id', 'bill', 'discount', 'paid', 'bill_date', 'full_paid'];

    protected $dates = ['bill_date'];

    public function game()
    {

        return $this->belongsTo('App\Game');
    }


    public function getBillDateAttribute($value)
    {
        if (!is_null($value)) {
//            return Carbon::createFromFormat('Y-m-d', $value);
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
