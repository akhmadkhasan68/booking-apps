<?php

use App\Http\Controllers\BookingController;
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

Route::get('/dashboard', function () {
    return view('admin/dashboard');
});

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
// Route::post('/admin/room/updateS', 'RoomController@update');
Route::get('/admin/room/delete/{id}', 'RoomController@destroy')->name('deleteroom');
//usermanagement
Route::get('/admin/usermanagement', 'UserManagementController@index')->name('usermanagement');
// Route::get('/admin/usermanagement/usermanagement', 'UserManagementController@create')->name('adduser');
// Route::post('/admin/usermanagement/store', 'UserManagementController@store')->name('save');
Route::get('/admin/usermanagement/edituser/{id}', 'UserManagementController@edit')->name('edituser');
Route::post('/admin/usermanagement/update/{id}', 'UserManagementController@update')->name('update');
Route::get('/admin/usermanagement/delete/{id}', 'UserManagementController@destroy')->name('deleteuser');

//bookings
Route::get('/admin/booking', 'BookingController@index')->name('booking');

//report
Route::get('/admin/reports', 'ReportsController@index')->name('report');

Route::post('/admin/authlogin', 'AuthController@login');
Route::get('/admin/authlogout', 'AuthController@logout');
// Route::get('/admin/authlogout', 'AuthController@index')->name('logout');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout');
