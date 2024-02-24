<?php

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Booking\BookingController;
use App\Http\Controllers\Api\Divisions\DivisionController;
use App\Http\Controllers\Api\Feedback\FeedbackController;
use App\Http\Controllers\Api\Profile\ProfileController;
use App\Http\Controllers\Api\Room\RoomController;
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

Route::get('/', function(){
    return ApiResponseHelper::successResponse("Welcome to booking apps API", []);
});

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::group(['prefix' => 'auth'], function() {
        Route::post('login', [AuthController::class, 'login'])->name('login.api');
        Route::post('register',[AuthController::class, 'register'])->name('register.api');
    });
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::group(['prefix' => 'auth'], function() {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
    
    Route::group(['prefix' => 'rooms'], function() {
        Route::get('', [RoomController::class, 'paginate']);
        Route::get('/schedules', [RoomController::class, 'schedules']);
        Route::get('/schedules/{id}', [RoomController::class, 'scheduleDetail']);
        Route::post('/search-available', [RoomController::class, 'searchAvailable']);
        Route::post('/search-unavailable', [RoomController::class, 'searchUnvailable']);
        Route::get('/{id}', [RoomController::class, 'detail']);
    });
    
    Route::group(['prefix' => 'booking'], function() {
        Route::get('/', [BookingController::class, 'getAllBooking']);
        Route::get('/{id}', [BookingController::class, 'getDetailBooking']);
        Route::post('/', [BookingController::class, 'booking']);
    });
    
    Route::group(['prefix' => 'feedbacks'], function() {
        Route::get('/', [FeedbackController::class, 'feedbacks']);
        Route::get('/{id}', [FeedbackController::class, 'feedbackDetail']);
        Route::post('/', [FeedbackController::class, 'create']);
    });
    
    Route::group(['prefix' => 'profile'], function() {
        Route::put('/update-photo', [ProfileController::class, 'updatePhoto']);
        Route::put('/', [ProfileController::class, 'updateMemberProfile']);
    });

    Route::group(['prefix' => 'divisions'], function() {
        Route::get('/', [DivisionController::class, 'index']);
        Route::get('/{id}', [DivisionController::class, 'detail']);
    });
});
