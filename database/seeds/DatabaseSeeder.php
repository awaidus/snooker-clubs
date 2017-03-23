<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClubsTableSeeder::class);
        $this->call(GameTypesTableSeeder::class);
        $this->call(GameTablesTableSeeder::class);
        $this->call(GamesTableSeeder::class);
        $this->call(BillsTableSeeder::class);
        $this->call(PlayersTableSeeder::class);

    }
}
