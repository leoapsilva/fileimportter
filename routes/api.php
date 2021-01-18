<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ImportFileApiController;
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

// Bonus - middleware('auth:api')->

// ImportFile API
Route::get( '/import-files', 'Api\ApiImportFileController@index');

Route::get( '/import-files/{id}', 'Api\ApiImportFileController@show');

// People API
Route::get( '/people', 'Api\ApiPersonController@index');

Route::get( '/people/{id}', 'Api\ApiPersonController@show');

// ShipOrder API
Route::get( '/ship-orders', 'Api\ApiShipOrderController@index');

Route::get( '/ship-orders/{id}', 'Api\ApiShipOrderController@show');
