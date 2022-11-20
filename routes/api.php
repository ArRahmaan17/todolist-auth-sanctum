<?php

use App\Http\Controllers\Lists as ControllersLists;
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
    if (empty($data)) {
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
        'data' => $data,
    ];
    return Response()->json($response, 200);
});

Route::post('/store', function (Request $request) {
    $request->validate(['name' => 'required']);
    $data = [
        'name' => $request->name
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

Route::post('/edit', function (Request $request) {
    $list = lists::specificList((int)$request->id);
    if (empty($list)) {
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
        'data' => $list,
    ];
    return Response()->json($response, 404);
});

Route::put('/update', function (Request $request) {
    $request->validate(['name' => 'required']);
    $updatedList = ['id' => $request->id, 'name' => $request->name];
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
    return Response()->json($response, 401);
});
