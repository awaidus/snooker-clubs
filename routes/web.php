<?php


Route::group(['middleware' => 'guest'], function () {

    Route::get('/login', 'AuthController@login')->name('login');

    Route::post('/login', 'AuthController@postLogin')->name('login');

    Route::get('/register', 'UserController@showRegistration')->name('showRegistration');
    Route::post('/register', 'UserController@storeUser')->name('storeUser');

});

Route::group(['middleware' => 'manager'], function () {

    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::get('/', 'ClubController@index')->name('home');


    Route::get('{club_id}/game-table/show/{id?}', 'GameTableController@show')->name('showGameTable');
    Route::post('game-table/store', 'GameTableController@store')->name('storeGameTable');


    Route::get('{club_id}/games/index', 'GameController@index')->name('showGames');
    Route::get('{club_id}/game/show/{id?}', 'GameController@show')->name('showGame');
    Route::get('{club_id}/game/show/', 'GameController@create')->name('createGame');
    Route::post('game/store', 'GameController@store')->name('storeGame');


    Route::get('bills/index', 'BillController@index')->name('showBills');
    Route::get('{club_id}/game/{game_id}/bill/show/{id?}', 'BillController@show')->name('showBill');
    Route::post('bill/store', 'BillController@store')->name('storeBill');


    Route::get('player/index', 'PlayerController@index')->name('showPlayers');
    Route::get('player/{id?}', 'PlayerController@show')->name('showPlayer');
    Route::post('player/store', 'PlayerController@store')->name('storePlayer');


    Route::group(['middleware' => 'admin'], function () {

        Route::get('club/show/{id?}', 'ClubController@show')->name('showClub');
        Route::post('club/store', 'ClubController@store')->name('storeClub');

        Route::get('/user/index', 'UserController@index')->name('showUsers');


    });
});


Route::get('/test', function () {

    //return $g = Sentinel::getUser()->id;
//    return $g = \App\Game::with('bill')->get();
////    return $g = Sentinel::getRoleRepository()->get();

    $g = \App\GameTable::with('bills')->get();

    $g->first()->bills->sum('bill');

    $bill = $g->each(function ($item, $key) {

        echo 'Sum Bill  ' . $item->bills->sum('bill') . '<br>';

        echo '<hr>';
    });

    $clubs = \App\Club::with('tables.bills')->get();

    $bill = $clubs->each(function ($item, $key) {

        echo 'Game ' . $item->club_name . '<br>';
        echo 'No. of Bill  ' . $item->tables->count('bill') . '<br>';
        echo 'Sum Bill  ' . $b = $item->tables->each(function ($table, $key) {
                    return $table->sum('bills.bill');
                })
                . '<br>';
        echo 'Pending Bill  ' . $item->tables . '<br>';
        echo '<hr>';
    });

    //return $c;

//    return $b;


//    return
//    [
//        'club' => $b->club_name,
//
////        'Total No. of bill (cleared)' => $b->where('full_paid', true)->count('full_paid'),
////        'Total No. of balanced bill (balanced)' => $b->where('full_paid', false)->count('full_paid')
//    ];

//    $g = \App\Bill::with('game')->get();
//    return $g->first()->game()-with('bill')->get();


//    $a = \App\Club::get();
//    return $a->first()->tables()->with(['games' => function ($query) {
//        $query->whereCompleted(false);
//    }])->get();

//    dd($club = \App\Club::with('tables.games.bill')->get());

//    return $a->games()->whereCompleted(true)->get();
//    return \App\Game::with(['table' => function ($query) {
//        $query->where('club_id', 3);
//    }])->get();


    /*return \App\Game::with('table', 'player')
        ->whereHas('table', function ($query) {
            $query->where('club_id', 2);
        })->get();*/

});

