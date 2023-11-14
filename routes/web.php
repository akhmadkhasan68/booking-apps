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

/**
 * Login
 */
Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/admin/authlogin', 'AuthController@login');
Route::get('/admin/authlogout', 'AuthController@logout');

Route::get('/register', function () {
    return view('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/usermanagement', function () {
            return view('usermanagement/usermanagement');
        });

        Route::get('/usermanagement/edituser', function () {
            return view('usermanagement/edituser');
        });

        Route::get('/room', function () {
            return view('room/room');
        });

        Route::get('/booking', function () {
            return view('booking/booking');
        });

        Route::get('/reports', function () {
            return view('reports/reports');
        });

        Route::get('/room/addroom', function () {
            return view('room/addroom');
        });

        Route::get('/room/editfacility', function () {
            return view('room/editfacility');
        });

        //route untuk room
        Route::get('/room', 'RoomController@index')->name('room');
        Route::get('/room/addroom', 'RoomController@create')->name('addroom');
        Route::post('/room/store', 'RoomController@store')->name('storeroom');
        Route::get('/room/editfacility/{id}', 'RoomController@edit')->name('editfacility');
        Route::put('/room/update/{id}', 'RoomController@update')->name('update');
        Route::get('/room/delete/{id}', 'RoomController@destroy')->name('deleteroom');

        //usermanagement
        Route::get('/usermanagement', 'UserManagementController@index')->name('usermanagement');
        Route::get('/admin/usermanagement/adduser', 'UserManagementController@create')->name('adduser');
        Route::post('/admin/usermanagement/store', 'UserManagementController@store')->name('storeuser');
        Route::get('/usermanagement/edituser/{id}', 'UserManagementController@edit')->name('edituser');
        Route::get('/usermanagement/detailuser/{id}', 'UserManagementController@show')->name('detailuser');
        Route::post('/usermanagement/update/{id}', 'UserManagementController@update')->name('update');
        Route::get('/usermanagement/delete/{id}', 'UserManagementController@destroy')->name('deleteuser');

        //bookings
        Route::get('/booking', 'BookingController@index')->name('booking');
        Route::get('/booking/{id}', 'BookingController@show')->name('detailbooking');
        // Route::get('/booking/approvebooking/{id}', 'BookingController@approvebooking')->name('approvebooking');
        // Route::post('/booking/approvebookingaction', 'BookingController@approvebookingaction')->name('approvebookingaction');
        Route::post('/booking/cancel/{id}', 'BookingController@cancel')->name('cancelbooking');
        Route::post('/booking/approvebooking/{id}', 'BookingController@approvebooking')->name('approvebooking');

        //report
        Route::get('/reports', 'ReportsController@index')->name('report');
        Route::get('/reports/{id}', 'ReportsController@show')->name('detailreport');

        Route::get('/logout', 'AuthController@logout')->name('logout');
    });
});
