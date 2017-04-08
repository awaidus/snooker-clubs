<?php

namespace App\Listeners;

use App\Events\GameUpdated;
use App\Transaction;

class UpdateTransaction
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
     * @param  GameCreated $event
     * @return void
     */
    public function handle(GameUpdated $event)
    {
        return $transaction = Transaction::where('game_id', $event->game->id)->first();

        $transaction->game_id = $event->game->id;
        $transaction->player_id = $event->game->player_id;
        $transaction->amount = -($event->game->bill - $event->game->discount);
        $transaction->save();
    }
}
