<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('players', function () {

    return response()->json(\App\Player::get()->pluck('player_name', 'id'));

})->name('getPlayers');


Route::get('allPlayers', function () {

    return response()->json(\App\Player::with('transactions')->get());

})->name('allPlayers');

Route::get('allGames/{club_id}', function ($club_id) {

    if (!is_null($club_id))
        return response()->json(\App\Club::where('id', $club_id)->with('games.players', 'games.game_type')->first());

    return response()->json('No data found');

})->name('getGames');


Route::get('destroyPlayer/{id}', 'PlayerController@destroy')->name('destroyPlayer');
Route::get('restorePlayer/{id}', 'PlayerController@restore')->name('restorePlayer');


Route::group(['middleware' => 'manager'], function () {

});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
