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
Route::get('/', function () {
    return view('welcome');
});




/*Route::group(['prefix' => 'reportings'], function(){
    Route::get('/', [App\Http\Controllers\ReportingController::class, 'index']);
});
*/
Route::group(['prefix' => 'imports'], function(){
    Route::get('/', function () {
        return view('imports.index');
    });
    
});
Route::group(['prefix' => 'reportings'], function(){
    Route::get('/', function () {
        return view('reportings.index');
    });
    Route::get('/data',[App\Http\Controllers\ReportingController::class, 'getdata'])->name('reportings.getdata');
});

Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false
]); 
Route::post('/imports/importHygiene',[App\Http\Controllers\InfrastructureController::class,'importHygiene'])->name('infra.importHygiene');
Route::post('/imports/importInfrastructure',[App\Http\Controllers\InfrastructureController::class,'importInfrastructure'])->name('infra.importInfrastructure');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('localites', App\Http\Controllers\LocaliteController::class);
Route::resource('communes', App\Http\Controllers\CommuneController::class);
Route::resource('menages', App\Http\Controllers\MenageController::class);
Route::resource('bayeurs', App\Http\Controllers\BayeurController::class);
Route::resource('projets', App\Http\Controllers\ProjetController::class);
Route::resource('intervenants', App\Http\Controllers\IntervenantController::class);

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/users', [App\Http\Controllers\UsersController::class, 'index']);
Route::get('/users/create',[App\Http\Controllers\UsersController::class, 'create'])->name('users.create');
Route::post('/users/store',[App\Http\Controllers\UsersController::class, 'store']);
Route::get('/users/edit/{id}',[App\Http\Controllers\UsersController::class, 'edit']);
Route::get('/users/{id}',[App\Http\Controllers\UsersController::class, 'show']);
Route::put('/users/{id}',[App\Http\Controllers\UsersController::class, 'update']);
Route::delete('/users/{id}',[App\Http\Controllers\UsersController::class, 'destroy']);

Route::post('/users/modifyStatus',[App\Http\Controllers\UsersController::class, 'modifyStatus'])->name('users.modifyStatus');
Route::post('/users/modifyPassword',[App\Http\Controllers\UsersController::class, 'modifyPassword'])->name('users.modifyPassword');


Route::get('/profile/show/{id}', [App\Http\Controllers\ProfileController::class, 'show']);
Route::get('/profile/edit/{id}',[App\Http\Controllers\ProfileController::class, 'edit']);
Route::put('/profile/create',[App\Http\Controllers\ProfileController::class, 'create']);



Route::get('/maps', [App\Http\Controllers\MapController::class, 'index']);

Route::get('/maps/getinfra', [App\Http\Controllers\MapController::class, 'getinf'])->name('maps.getinfra');