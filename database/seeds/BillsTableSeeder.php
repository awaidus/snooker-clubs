<?php

use Illuminate\Database\Seeder;

class BillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bill = new \App\Bill([
            'game_id' => 1,
            'bill' => 60,
            'discount' => 10,
            'paid' => 50,
            'full_paid' => 1,
        ]);
        $bill->save();

        $bill = new \App\Bill([
            'game_id' => 2,
            'bill' => 40,
            'discount' => 0,
            'paid' => 0,
            'full_paid' => 0,
        ]);
        $bill->save();

        $bill = new \App\Bill([
            'game_id' => 4,
            'bill' => 50,
            'discount' => 0,
            'paid' => 50,
            'full_paid' => 1,
        ]);
        $bill->save();

        $bill = new \App\Bill([
            'game_id' => 5,
            'bill' => 100,
            'discount' => 20,
            'paid' => 50,
            'full_paid' => 0,

        ]);
        $bill->save();

        $bill = new \App\Bill([
            'game_id' => 6,
            'bill' => 150,
            'discount' => 0,
            'paid' => 100,
            'full_paid' => 0,

        ]);
        $bill->save();

        $bill = new \App\Bill([
            'game_id' => 7,
            'bill' => 50,
            'discount' => 0,
            'paid' => 50,
            'full_paid' => 1,

        ]);
        $bill->save();

        
    }
}
