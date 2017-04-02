<?php

namespace App\Listeners;

use App\Events\GameCreated;
use App\Transaction;

class SetBill
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  GameCreated  $event
     * @return void
     */
    public function handle(GameCreated $event)
    {

//        $bill = new Bill();
//
//        $bill->game_id = $event->game->id;
//
//        $bill->save();

        $transaction = new Transaction();
        $transaction->game_id = $event->game->id;
        $transaction->player_id = $event->game->player_id;
        $transaction->amount = -($event->game->bill - $event->game->discount);
        $transaction->save();
    }
}
