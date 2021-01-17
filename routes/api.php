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
Route::get( '/import-files', 'Api\ApiImportFileController@index');

// Bonus - middleware('auth:api')->
Route::get( '/import-files/{id}', 'Api\ApiImportFileController@show');
