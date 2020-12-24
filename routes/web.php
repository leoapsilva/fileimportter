<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ImportFileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Dashboard Routes

Route::get('/dashboard', function(){
    return view('dashboard');
});


// Customer Routes
Route::get('/customers/create', [CustomerController::class, 'create'])
    ->name('customers.create')
    ->middleware('auth');

Route::get('/customers', [CustomerController::class, 'index'])
    ->name('customers.index')
    ->middleware('auth');

Route::post('/customers', [CustomerController::class, 'store'])
    ->name('customers.store')
    ->middleware('auth');

Route::put('/customers/{customer}', [CustomerController::class, 'update'])
    ->name('customers.update')
    ->middleware('auth');

Route::get('/customers/{customer}', [CustomerController::class, 'show'])
    ->name('customers.show')
    ->middleware('auth');

Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])
    ->name('customers.destroy')
    ->middleware('auth');

Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])
    ->name('customers.edit')
    ->middleware('auth');

Route::get('/customers/{customer}/delete', [CustomerController::class, 'delete'])
    ->name('customers.delete')
    ->middleware('auth');


// Import Customer Routes
Route::get('/import-files/create', [ImportFileController::class, 'create'])
    ->name('import-files.create')
    ->middleware('auth');

Route::get('/import-files', [ImportFileController::class, 'index'])
    ->name('import-files.index')
    ->middleware('auth');

Route::post('/import-files', [ImportFileController::class, 'store'])
    ->name('import-files.store')
    ->middleware('auth');

Route::get('/import-files/{customer}', [ImportFileController::class, 'show'])
    ->name('import-files.show')
    ->middleware('auth');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("/", [App\Http\Controllers\HomeController::class, 'index'])->name('home');
