<?php


Route::group(['middleware' => 'guest'], function () {

    Route::get('/login', 'AuthController@login')->name('login');

    Route::post('/login', 'AuthController@postLogin')->name('login');

});

Route::group(['middleware' => 'admin'], function () {

    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::get('/', 'ClubController@index')->name('home');

    Route::get('club/show/{id?}', 'ClubController@show')->name('showClub');
    Route::post('club/store', 'ClubController@store')->name('storeClub');


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


    Route::group(['middleware' => 'super'], function () {

        Route::get('/register', 'AuthController@showRegistration')->name('showRegistration');
        Route::post('/register', 'AuthController@storeUser')->name('storeUser');


    });
});


Route::get('/test', function () {


    return $g = \App\Game::all();

//    $g = \App\Bill::with('game')->get();
//    return $g->first()->game()-with('bill')->get();

//    $a = \App\Club::with('games.table')->first();
//    return $a->games()->whereCompleted(true)->get();
//    return \App\Game::with(['table' => function ($query) {
//        $query->where('club_id', 3);
//    }])->get();
    /*$b = \App\Bill::all();
    return ['Total bill amount' => $b->sum('bill'),
        'Total payment received' => $b->sum('paid'),
        'Total No. of bill (cleared)' => $b->where('full_paid', true)->count('full_paid'),
        'Total No. of balanced bill (balanced)' => $b->where('full_paid', false)->count('full_paid')
    ];*/


    /*return \App\Game::with('table', 'player')
        ->whereHas('table', function ($query) {
            $query->where('club_id', 2);
        })->get();*/

});

