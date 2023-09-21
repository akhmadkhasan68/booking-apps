<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
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
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/admin/usermanagement', function () {
    return view('admin/usermanagement/usermanagement');
});

Route::get('/admin/usermanagement/edituser', function () {
    return view('admin/usermanagement/edituser');
});

Route::get('/admin/room', function () {
    return view('admin/room/room');
});

Route::get('/admin/booking', function () {
    return view('admin/booking/booking');
});

Route::get('/admin/reports', function () {
    return view('admin/reports/reports');
});

Route::get('/admin/room/addroom', function () {
    return view('admin/room/addroom');
});

Route::get('/admin/room/editfacility', function () {
    return view('admin/room/editfacility');
});

//route untuk room
Route::get('/admin/room', 'RoomController@index')->name('room');
Route::get('/admin/room/addroom', 'RoomController@create')->name('addroom');
Route::post('/admin/room/store', 'RoomController@store')->name('save');
Route::get('/admin/room/editfacility/{id}', 'RoomController@edit')->name('editfacility');
Route::put('/admin/room/update/{id}', 'RoomController@update')->name('update');
Route::get('/admin/room/delete/{id}', 'RoomController@destroy')->name('deleteroom');

//usermanagement
Route::get('/admin/usermanagement', 'UserManagementController@index')->name('usermanagement');
Route::get('/admin/usermanagement/edituser/{id}', 'UserManagementController@edit')->name('edituser');
Route::get('/admin/usermanagement/detailuser/{id}', 'UserManagementController@show')->name('detailuser');
Route::post('/admin/usermanagement/update/{id}', 'UserManagementController@update')->name('update');
Route::get('/admin/usermanagement/delete/{id}', 'UserManagementController@destroy')->name('deleteuser');

//bookings
Route::get('/admin/booking', 'BookingController@index')->name('booking');
Route::get('/admin/booking/{id}', 'BookingController@show')->name('detailbooking');
Route::get('/admin/booking/approvebooking/{id}', 'BookingController@approvebooking')->name('approvebooking');
Route::post('/admin/booking/approvebookingaction', 'BookingController@approvebookingaction')->name('approvebookingaction');
Route::post('/admin/booking/cancel/{id}', 'BookingController@cancel')->name('cancelbooking');

//report
Route::get('/admin/reports', 'ReportsController@index')->name('report');
Route::get('/admin/reports/{id}', 'ReportsController@show')->name('detailreport');

Route::post('/admin/authlogin', 'AuthController@login');
Route::get('/admin/authlogout', 'AuthController@logout');
// Route::get('/admin/authlogout', 'AuthController@index')->name('logout');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout');
