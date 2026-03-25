<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LibraryController;
use App\Http\Controllers\Api\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::name('api.')->group(function () {
    Route::post('login', [AuthController::class, 'authentication'])->name('login');
    Route::post('registration', [AuthController::class, 'registration'])->name('registration');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Todos routes
    Route::prefix('todos')->group(function () {
        Route::get('/', [TodoController::class, 'index']);
        Route::post('/', [TodoController::class, 'store']);
        Route::get('/{id}', [TodoController::class, 'show']);
        Route::put('/{id}', [TodoController::class, 'update']);
        Route::delete('/{id}', [TodoController::class, 'destroy']);
    });

    // Library routes
    Route::get('library', [LibraryController::class, 'index'])->name('library.index');
    Route::get('library/search/', [LibraryController::class, 'filter'])->name('library.filter');
    Route::post('library/store', [LibraryController::class, 'store'])->name('library.store');
    Route::get('library/show/{id}', [LibraryController::class, 'show'])->name('library.show');
    Route::put('library/update/{id}', [LibraryController::class, 'update'])->name('library.update');
    Route::delete('library/delete/{id}', [LibraryController::class, 'destroy'])->name('library.destroy');

    // Authors routes
    Route::get('author', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('author/search/', [AuthorController::class, 'filter'])->name('authors.filter');
    Route::post('author/store', [AuthorController::class, 'store'])->name('authors.store');
    Route::get('author/show/{id}', [AuthorController::class, 'show'])->name('authors.show');
    Route::put('author/update/{id}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('author/delete/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');

    // Category routes
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/search/', [CategoryController::class, 'filter'])->name('category.filter');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/show/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::put('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Books routes
    Route::get('books', [BookController::class, 'index'])->name('books.index');
    Route::get('books/search/', [BookController::class, 'filter'])->name('books.filter');
    Route::post('books/store', [BookController::class, 'store'])->name('books.store');
    Route::get('books/show/{id}', [BookController::class, 'show'])->name('books.show');
    Route::put('books/update/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('books/delete/{id}', [BookController::class, 'destroy'])->name('books.destroy');
});
