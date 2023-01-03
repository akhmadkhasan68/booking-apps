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