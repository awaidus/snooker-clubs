<?php

use Illuminate\Database\Seeder;

class GameTablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t = new  \App\GameTable([
            'club_id' => 1,
            'table_no' => 'D-01-01',
        ]);
        $t->save();

        $t = new  \App\GameTable([
            'club_id' => 1,
            'table_no' => 'D-01-02',
        ]);
        $t->save();

        $t = new  \App\GameTable([
            'club_id' => 1,
            'table_no' => 'D-01-03',
        ]);
        $t->save();

        $t = new  \App\GameTable([
            'club_id' => 1,
            'table_no' => 'D-01-04',
        ]);
        $t->save();

        $t = new  \App\GameTable([
            'club_id' => 1,
            'table_no' => 'D-01-05',
        ]);
        $t->save();

        $t = new  \App\GameTable([
            'club_id' => 2,
            'table_no' => 'D-02-01',
        ]);
        $t->save();

        $t = new  \App\GameTable([
            'club_id' => 2,
            'table_no' => 'D-02-02',
        ]);
        $t->save();

        $t = new  \App\GameTable([
            'club_id' => 2,
            'table_no' => 'D-02-03',
        ]);
        $t->save();

        $t = new  \App\GameTable([
            'club_id' => 2,
            'table_no' => 'D-02-04',
        ]);
        $t->save();

        $t = new  \App\GameTable([
            'club_id' => 2,
            'table_no' => 'D-02-05',
        ]);
        $t->save();

        $t = new  \App\GameTable([
            'club_id' => 1,
            'table_no' => 'D-01-06',
        ]);
        $t->save();

        $t = new  \App\GameTable([
            'club_id' => 3,
            'table_no' => 'D-03-01',
        ]);
        $t->save();

        $t = new  \App\GameTable([
            'club_id' => 3,
            'table_no' => 'D-03-02',
        ]);
        $t->save();

        $t = new  \App\GameTable([
            'club_id' => 3,
            'table_no' => 'D-03-03',
        ]);
        $t->save();


    }
}
