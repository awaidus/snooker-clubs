<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    public function run()
    {
        $game = new \App\Game([
            'game_table_id' => '1',
            'game_type_id' => '1',
            'player_id' => '1',
            'completed' => '1',
            'no_of_players' => '2',
            'started_at' => \Carbon\Carbon::now(),
            'ended_at' => \Carbon\Carbon::now()->addHour(1),
        ]);
        $game->save();

        $game = new \App\Game([
            'game_table_id' => '2',
            'game_type_id' => '4',
            'player_id' => '3',
            'completed' => '0',
            'no_of_players' => '2',
            'started_at' => \Carbon\Carbon::now(),
            'ended_at' => \Carbon\Carbon::now()->addHour(1),
        ]);
        $game->save();

        $game = new \App\Game([
            'game_table_id' => '3',
            'game_type_id' => '3',
            'player_id' => '2',
            'completed' => '1',
            'no_of_players' => '4',
            'started_at' => \Carbon\Carbon::now(),
            'ended_at' => \Carbon\Carbon::now()->addHour(1),
        ]);
        $game->save();

        $game = new \App\Game([
            'game_table_id' => '4',
            'game_type_id' => '1',
            'player_id' => '1',
            'completed' => '0',
            'no_of_players' => '2',
            'started_at' => \Carbon\Carbon::now(),
            'ended_at' => \Carbon\Carbon::now()->addHour(1),
        ]);
        $game->save();

        $game = new \App\Game([
            'game_table_id' => '8',
            'game_type_id' => '1',
            'player_id' => '2',
            'completed' => '1',
            'no_of_players' => '2',
            'started_at' => \Carbon\Carbon::now(),
            'ended_at' => \Carbon\Carbon::now()->addHour(1),
        ]);
        $game->save();

        $game = new \App\Game([
            'game_table_id' => '7',
            'game_type_id' => '2',
            'player_id' => '1',
            'completed' => '1',
            'no_of_players' => '2',
            'started_at' => \Carbon\Carbon::now(),
            'ended_at' => \Carbon\Carbon::now()->addHour(1),
        ]);
        $game->save();

        $game = new \App\Game([
            'game_table_id' => '6',
            'game_type_id' => '1',
            'player_id' => '2',
            'completed' => '1',
            'no_of_players' => '4',
            'started_at' => \Carbon\Carbon::now(),
            'ended_at' => \Carbon\Carbon::now()->addHour(1),
        ]);
        $game->save();

        $game = new \App\Game([
            'game_table_id' => '8',
            'game_type_id' => '1',
            'player_id' => '3',
            'completed' => '0',
            'no_of_players' => '4',
            'started_at' => \Carbon\Carbon::now(),
            'ended_at' => \Carbon\Carbon::now()->addHour(1),
        ]);
        $game->save();

        $game = new \App\Game([
            'game_table_id' => '9',
            'game_type_id' => '1',
            'player_id' => '2',
            'completed' => '1',
            'no_of_players' => '2',
            'started_at' => \Carbon\Carbon::now(),
            'ended_at' => \Carbon\Carbon::now()->addHour(1),
        ]);
        $game->save();


        $game = new \App\Game([
            'game_table_id' => '12',
            'game_type_id' => '2',
            'player_id' => '2',
            'completed' => '1',
            'no_of_players' => '2',
            'started_at' => \Carbon\Carbon::now(),
            'ended_at' => \Carbon\Carbon::now()->addHour(1),
        ]);
        $game->save();

        $game = new \App\Game([
            'game_table_id' => '13',
            'game_type_id' => '1',
            'player_id' => '3',
            'completed' => '0',
            'no_of_players' => '4',
            'started_at' => \Carbon\Carbon::now(),
            'ended_at' => \Carbon\Carbon::now()->addHour(1),
        ]);
        $game->save();

        $game = new \App\Game([
            'game_table_id' => '14',
            'game_type_id' => '3',
            'player_id' => '3',
            'completed' => '1',
            'no_of_players' => '2',
            'started_at' => \Carbon\Carbon::now(),
            'ended_at' => \Carbon\Carbon::now()->addHour(1),
        ]);
        $game->save();
    }
}
