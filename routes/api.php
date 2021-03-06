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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api']], function() {
    Route::post('/restaurant', 'RestaurantController@store');
    Route::post('/restaurant/menu', 'MenuController@getRestaurantMenu');
    Route::post('/order/save', 'RestaurantOrderController@store');
});

Route::post('/item/save', 'MenuController@saveMenuItem');
