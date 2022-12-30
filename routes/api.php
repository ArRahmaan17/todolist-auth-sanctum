<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LibraryController;
use App\Http\Controllers\UserController;
use App\Models\lists;
use App\Models\User;
use Illuminate\Http\Request;
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

Route::post('login', [AuthController::class, 'authentication'])->name('login');
Route::post('registration', [AuthController::class, 'registration'])->name('registration');

Route::get('/show', function () {
    $data = lists::showAllList();
    if (empty(json_decode($data))) {
        $response = [
            'status' => 'failed',
            'message' => 'we are cant find your lists',
            'data' => null,
        ];
        return Response()->json($response, 404);
    }
    $response = [
        'status' => 'success',
        'message' => 'we found your lists',
        'data' => json_decode($data),
    ];
    return Response()->json($response, 200);
});

Route::post('/store', function (Request $request) {
    $request->validate(['name' => 'required']);
    $data = [
        'name' => $request->name,
        'created_at' => now(),
    ];
    if (!lists::storeList($data)) {
        $response = [
            'status' => 'failed',
            'message' => 'we are failed to add your new list'
        ];
        return Response()->json($response, 401);
    }
    $response = [
        'status' => 'success',
        'message' => 'Your new list added successfully'
    ];
    return Response()->json($response, 200);
});

Route::get('/edit/{id}', function ($id) {
    $list = lists::specificList((int)$id);
    if (empty(json_decode($list))) {
        $response = [
            'status' => 'failed',
            'message' => "we cant find your list ",
            'data' => null,
        ];
        return Response()->json($response, 404);
    }
    $response = [
        'status' => 'success',
        'message' => "we find your list ",
        'data' => json_decode($list),
    ];
    return Response()->json($response, 200);
});

Route::put('/update', function (Request $request) {
    $request->validate(['name' => 'required']);
    $updatedList = ['id' => $request->id, 'name' => $request->name, 'updated_at' => now()];
    if (!lists::updateSpecificList($updatedList)) {
        $response = [
            'status' => 'failed',
            'message' => 'we are failed to update your list'
        ];
        return Response()->json($response, 401);
    }
    $response = [
        'status' => 'success',
        'message' => 'Your list updated successfully'
    ];
    return Response()->json($response, 200);
});

Route::delete('/delete/{id}', function ($id) {
    if (!lists::removeList((int)$id)) {
        $response = [
            'status' => 'failed',
            'message' => 'we cant remove the specified list'
        ];
        return Response()->json($response, 401);
    }
    $response = [
        'status' => 'success',
        'message' => 'your list successfully removed'
    ];
    return Response()->json($response, 200);
});


// online
// Route::middleware('auth:sanctum')->group(function () {

Route::post('logout', [AuthController::class, 'logout']);
// library routes
Route::get('library', [LibraryController::class, 'index'])->name('library.index');
Route::get('library/search/', [LibraryController::class, 'filter'])->name('library.filter');
Route::post('library/store', [LibraryController::class, 'store'])->name('library.store');
Route::get('library/show/{id}', [LibraryController::class, 'show'])->name('library.show');
Route::put('library/update/{id}', [LibraryController::class, 'update'])->name('library.update');
Route::delete('library/delete/{id}', [LibraryController::class, 'delete'])->name('library.delete');

// authors routes
Route::get('author', [AuthorController::class, 'index'])->name('authors.index');
Route::get('author/search/', [AuthorController::class, 'filter'])->name('authors.filter');
Route::post('author/store', [AuthorController::class, 'store'])->name('authors.store');
Route::get('author/show/{id}', [AuthorController::class, 'show'])->name('authors.show');
Route::put('author/update/{id}', [AuthorController::class, 'update'])->name('authors.update');
Route::delete('author/delete/{id}', [AuthorController::class, 'delete'])->name('authors.delete');

Route::get('caregory', [CategoryController::class, 'index'])->name('category.index');
Route::get('caregory/search/', [CategoryController::class, 'filter'])->name('category.filter');
Route::post('caregory/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('caregory/show/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::put('caregory/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('caregory/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

Route::get('books', [BookController::class, 'index'])->name('books.index');
Route::get('books/search/', [BookController::class, 'filter'])->name('books.filter');
Route::post('books/store', [BookController::class, 'store'])->name('books.store');
Route::get('books/show/{id}', [BookController::class, 'show'])->name('books.show');
Route::put('books/update/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('books/delete/{id}', [BookController::class, 'delete'])->name('books.delete');
// });
