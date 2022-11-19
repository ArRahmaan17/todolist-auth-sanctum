<?php

use App\Http\Controllers\Lists;
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

Route::get('/', [Lists::class, 'index']);
Route::get('/show', [Lists::class, 'show']);
Route::post('/store', [Lists::class, 'store']);
Route::get('/edit', [Lists::class, 'edit']);
Route::put('/update', [Lists::class, 'update']);
Route::delete('/delete', [Lists::class, 'destroy']);
