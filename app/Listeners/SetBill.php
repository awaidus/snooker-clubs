<?php

namespace App\Listeners;

use App\Bill;
use App\Events\GameCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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

        $bill = new Bill();

        $bill->game_id = $event->game->id;

        $bill->save();
    }
}
