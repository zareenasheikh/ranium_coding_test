<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('category', App\Http\Controllers\HomeController::class);
Route::post('/call_api', [App\Http\Controllers\HomeController::class, 'call_api'])->name('call_api');


Route::post('stock_quote/delete', [App\Http\Controllers\HomeController::class, 'destroy']);




