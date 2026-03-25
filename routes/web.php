<?php

use App\Http\Controllers\Lists;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [UserController::class, 'index'])->name('login');
    Route::post('/login', [UserController::class, 'authenticate'])->name('login.post');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');

    // Forgot Password
    Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [Lists::class, 'index'])->name('lists');
    Route::post('/lists', [Lists::class, 'store'])->name('lists.store');
    Route::put('/lists/{id}', [Lists::class, 'update'])->name('lists.update');
    Route::patch('/lists/{id}/toggle', [Lists::class, 'toggle'])->name('lists.toggle');
    Route::delete('/lists/{id}', [Lists::class, 'destroy'])->name('lists.destroy');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
