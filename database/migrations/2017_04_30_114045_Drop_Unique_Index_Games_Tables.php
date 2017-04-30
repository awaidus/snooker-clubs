<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUniqueIndexGamesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_tables', function (Blueprint $table) {
            $table->dropUnique('game_tables_table_no_unique');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_tables', function (Blueprint $table) {
            //Put the index back when the migration is rolled back
            $table->unique('email');

        });
    }
}
