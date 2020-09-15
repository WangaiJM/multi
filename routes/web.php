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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->group(function(){
    Route::get('/login', [App\Http\Controllers\Auth\AdminController::class, 'showLoginForm'])->name('AdminLoginForm');
    Route::post('/login', [App\Http\Controllers\Auth\AdminController::class, 'login'])->name('AdminLogin');
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('adminDashboard');
});
