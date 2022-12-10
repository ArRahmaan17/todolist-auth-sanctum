<?php

use App\Http\Controllers\authorsController;
use App\Http\Controllers\booksController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\Lists;
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

// Route::middleware('guest')->group(function () {
//     Route::get('/', [Lists::class, 'index'])->name('lists');
//     Route::get('/show', [Lists::class, 'show'])->name('list');
//     Route::get('/login', [UserController::class, 'index'])->name('login');
// });

// Route::middleware('logged')->group(function () {
//     // Crud TodoList
//     Route::post('/store', [Lists::class, 'store']);
//     Route::get('/edit', [Lists::class, 'edit']);
//     Route::put('/update', [Lists::class, 'update']);
//     Route::delete('/delete', [Lists::class, 'destroy']);

//     // CRUD Library
//     Route::resource('library', LibraryController::class);
//     Route::resource('category', categoryController::class);
//     Route::resource('authors', authorsController::class);
//     Route::resource('books', booksController::class);
// });
