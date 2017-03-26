<?php

use Illuminate\Database\Seeder;

class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $club = new \App\Club([
            'club_name' => 'D-04',
            'manager_id' => 1,
            'club_address' => 'Peshwar Morr, Isd',
            'no_of_tables' => '11',
        ]);
        $club->save();

        $club = new \App\Club([
            'club_name' => 'D-05',
            'manager_id' => 1,
            'club_address' => 'Chandni Chow, Rwp',
            'no_of_tables' => '12',
        ]);
        $club->save();

        $club = new \App\Club([
            'club_name' => 'D-06',
            'manager_id' => 1,
            'club_address' => 'Lahore 1233',
            'no_of_tables' => '20',
        ]);
        $club->save();


        $club = new \App\Club([
            'club_name' => 'D-10',
            'manager_id' => 1,
            'club_address' => 'Lahore ABCED',
            'no_of_tables' => '08',
        ]);
        $club->save();
    }
}
