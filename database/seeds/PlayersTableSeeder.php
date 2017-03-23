<?php

use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c = new \App\Player([
            'player_name' => 'Zulfiqar',
            'contact' => '0333-xxxxxxx',
        ]);
        $c->save();

        $c = new \App\Player([
            'player_name' => 'Hameed Junaid',
            'contact' => '0333-xxxxxxx',
        ]);
        $c->save();

        $c = new \App\Player([
            'player_name' => 'Mubarike',
            'contact' => '0321-xxxxxxx',
        ]);
        $c->save();


    }
}
