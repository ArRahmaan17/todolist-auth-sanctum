<?php

use App\Http\Controllers\Lists;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [Lists::class, 'index'])->name('lists');
    Route::post('/lists', [Lists::class, 'store'])->name('lists.store');
    Route::put('/lists/{id}', [Lists::class, 'update'])->name('lists.update');
    Route::patch('/lists/{id}/toggle', [Lists::class, 'toggle'])->name('lists.toggle');
    Route::delete('/lists/{id}', [Lists::class, 'destroy'])->name('lists.destroy');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
