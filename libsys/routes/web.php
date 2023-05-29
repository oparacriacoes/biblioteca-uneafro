<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::get('/loan', [LoanController::class, 'index'])->name('loan.index');
    Route::get('/member', [MemberController::class, 'index'])->name('member.index');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user_edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user_edit', [UserController::class, 'update'])->name('user.update');
    Route::put('/user_password', [UserController::class, 'password'])->name('user.password');
});
