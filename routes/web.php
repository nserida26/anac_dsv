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
Route::get('/', function () {
    return view('dashboard');
});
*/


Route::group(['prefix' => 'maps'], function(){
    Route::get('/', function () {
        return view('maps.index');
    });
});
Route::group(['prefix' => 'reportings'], function(){
    Route::get('/', function () {
        return view('reportings.index');
    });
});
Route::group(['prefix' => 'imports'], function(){
    Route::get('/', function () {
        return view('imports.index');
    });
});

Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', function () {
    return view('profile');
});