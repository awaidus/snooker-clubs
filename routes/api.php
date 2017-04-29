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


Route::get('players/{club_id}', 'PlayerController@getAll')->name('players.data');

Route::get('players', function () {

    return response()->json(\App\Player::get()->pluck('player_name', 'id'));

})->name('getPlayers');

Route::get('destroyPlayer/{id}', 'PlayerController@destroy')->name('destroyPlayer');
Route::get('restorePlayer/{id}', 'PlayerController@restore')->name('restorePlayer');


Route::get('games/{club_id}', 'GameController@getGames')->name('getGames');

Route::get('gamesList/{club_id}', 'GameController@getGamesList')->name('api.getGamesList');

Route::group(['middleware' => 'manager'], function () {

});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
