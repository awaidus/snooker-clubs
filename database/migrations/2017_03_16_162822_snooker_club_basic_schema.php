<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SnookerClubBasicSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('club_name');
            $table->integer('manager_id');
            $table->string('club_address')->nullable();
            $table->integer('no_of_tables');
            $table->timestamps();
        });

        Schema::create('game_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('club_id');
            $table->string('table_no')->unique();
            $table->timestamps();
        });

        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('game_table_id');
            $table->integer('game_type_id');
            $table->integer('player_id');
            $table->integer('user_id');
            $table->string('no_of_players');
            $table->boolean('completed')->default(false);
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();

            $table->timestamps();
        });


        Schema::create('game_types', function (Blueprint $table) {
            $table->increments('id');

            $table->string('game_type');
            $table->integer('price')->default(0);
            
            $table->timestamps();
        });

        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('game_id');

            $table->integer('bill')->nullable()->default(0);
            $table->integer('discount')->nullable()->default(0);
            $table->integer('paid')->nullable()->default(0);
            $table->date('bill_date')->nullable();
            $table->boolean('full_paid')->default(0);

            $table->timestamps();
        });

        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');

            $table->string('player_name');
            $table->string('contact');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clubs');
        Schema::dropIfExists('game_tables');
        Schema::dropIfExists('games');
        Schema::dropIfExists('game_types');
        Schema::dropIfExists('bills');
        Schema::dropIfExists('players');
        
    }
}
