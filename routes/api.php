<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Room\RoomController;
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

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::group(['prefix' => 'auth'], function() {
        Route::post('login', [AuthController::class, 'login'])->name('login.api');
        Route::post('register',[AuthController::class, 'register'])->name('register.api');
    });
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::group(['prefix' => 'auth'], function() {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
    
    Route::group(['prefix' => 'rooms'], function() {
        Route::get('', [RoomController::class, 'all']);
        Route::get('paginate', [RoomController::class, 'paginate']);
        Route::get('/{id}', [RoomController::class, 'detail']);
    });
});
