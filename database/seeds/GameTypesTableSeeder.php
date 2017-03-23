<?php

use Illuminate\Database\Seeder;

class GameTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gt = new \App\GameType([
            'game_type' => '15B',
            'price' => 60,
        ]);
        $gt->save();

        $gt = new \App\GameType([
            'game_type' => '6B',
            'price' => 40,
        ]);
        $gt->save();

        $gt = new \App\GameType([
            'game_type' => '1B',
            'price' => 40,
        ]);
        $gt->save();

        $gt = new \App\GameType([
            'game_type' => 'Century',
            'price' => 250,
        ]);
        $gt->save();

    }
}
