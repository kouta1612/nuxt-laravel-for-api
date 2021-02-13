<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SocialLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(["middleware" => "api"], function () {
    Route::get('/authenticated-check', [AuthenticatedSessionController::class, 'isAuthenticated']);
    Route::post('/signup', [RegisteredUserController::class, 'store']);
    Route::post('/signin', [AuthenticatedSessionController::class, 'store']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::get('/google', [SocialLoginController::class, 'redirectToProvider']);
    Route::get('/google/callback', [SocialLoginController::class, 'handleProviderCallback']);
});
