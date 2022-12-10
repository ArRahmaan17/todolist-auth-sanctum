<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\LibraryController;
use App\Http\Controllers\UserController;
use App\Models\lists;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

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


// // online 
// Route::post('login', [AuthController::class, 'authentication']);
// Route::post('registration', [AuthController::class, 'registration']);
// // library routes
// Route::get('library', [LibraryController::class, 'index'])->name('library.index');
// Route::get('library/search/', [LibraryController::class, 'filter'])->name('library.filter');
// Route::post('library/store', [LibraryController::class, 'store'])->name('library.store');
// Route::get('library/show/{id}', [LibraryController::class, 'show'])->name('library.show');
// Route::put('library/update/{id}', [LibraryController::class, 'update'])->name('library.update');
// Route::delete('library/delete/{id}', [LibraryController::class, 'delete'])->name('library.delete');

// // authors routes
// Route::get('author', [AuthorController::class, 'index'])->name('authors.index');
// Route::get('author/search/', [AuthorController::class, 'filter'])->name('authors.filter');
// Route::post('author/store', [AuthorController::class, 'store'])->name('authors.store');
// Route::get('author/show/{id}', [AuthorController::class, 'show'])->name('authors.show');
// Route::put('author/update/{id}', [AuthorController::class, 'update'])->name('authors.update');
// Route::delete('author/delete/{id}', [AuthorController::class, 'delete'])->name('authors.delete');
