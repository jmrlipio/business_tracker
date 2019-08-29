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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', 'UserController@AuthRouteAPI');

// List sales
Route::get('sales', 'SaleController@index');

// List single sales
Route::get('sales/{id}', 'SaleController@show');

// Create new sale
Route::post('sale', 'SaleController@store');

// Sync device
Route::post('sync', 'SyncController@store');

// Delete sale
Route::delete('sale/{id}', 'SaleController@destroy');


// List business sales
Route::get('business', 'BusinessController@list');
Route::get('business/{id}/sales', 'SaleController@businessSales');

// Create new business
Route::post('business', 'BusinessController@store');

Route::put('business', 'BusinessController@store');

// Delete sale
Route::delete('business/{id}', 'BusinessController@destroy');
