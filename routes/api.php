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


Route::group(['middleware' => 'manager'], function () {

});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
