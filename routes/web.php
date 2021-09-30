<?php

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\MemberController;
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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/registrasi', [AuthController::class, 'registrasi']);
Route::get('/logout', [AuthController::class, 'logout']);


//--* Admin Route *--//
Route::prefix('admin')->middleware('auth:user')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard_admin']);
    Route::get('/list_member', [MemberController::class, 'list_member']);
    Route::resource('/member', MemberController::class);
    Route::resource('/user', UserController::class);
});


//--* Member Route *--//
Route::prefix('member')->middleware('auth:member')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard_member']);
});
