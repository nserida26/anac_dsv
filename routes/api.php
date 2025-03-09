<?php

use App\Http\Controllers\Api\AgentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Auth\CodeCheckController;
//use App\Http\Controllers\Auth\ResetPasswordController;
//use App\Http\Controllers\Auth\ForgotPasswordController;

// Password reset routes
//Route::post('password/email',  ForgotPasswordController::class);
//Route::post('password/code/check', CodeCheckController::class);
//Route::post('password/reset', ResetPasswordController::class);

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

Route::middleware("localization")->group(function () {});
Route::get('/demandeurs', [AgentController::class, 'index']);
Route::post('/enrollement', [AgentController::class, 'enroler']);
Route::post('/verification', [AgentController::class, 'verifier']);
