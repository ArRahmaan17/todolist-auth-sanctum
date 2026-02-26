<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ListTodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class TodoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/todos",
     *     summary="Get all todos",
     *     tags={"Todos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="List of todos"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $todos = Cache::remember("todos_user_{$userId}", 3600, function () use ($request) {
            return $request->user()->todos()->latest()->get();
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Todos retrieved successfully',
            'data' => $todos
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/todos",
     *     summary="Create a new todo",
     *     tags={"Todos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Buy groceries")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Todo created successfully"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $todo = $request->user()->todos()->create([
            'name' => $request->name,
            'is_done' => false
        ]);

        Cache::forget("todos_user_{$request->user()->id}");

        return response()->json([
            'status' => 'success',
            'message' => 'Todo created successfully',
            'data' => $todo
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/todos/{id}",
     *     summary="Get a specific todo",
     *     tags={"Todos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Todo details"),
     *     @OA\Response(response=404, description="Todo not found")
     * )
     */
    public function show(Request $request, $id)
    {
        $todo = $request->user()->todos()->find($id);

        if (!$todo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Todo not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Todo retrieved successfully',
            'data' => $todo
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/todos/{id}",
     *     summary="Update a todo",
     *     tags={"Todos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Updated todo name"),
     *             @OA\Property(property="is_done", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Todo updated successfully"),
     *     @OA\Response(response=404, description="Todo not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $todo = $request->user()->todos()->find($id);

        if (!$todo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Todo not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'is_done' => 'sometimes|required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $todo->update($request->only(['name', 'is_done']));

        Cache::forget("todos_user_{$request->user()->id}");

        return response()->json([
            'status' => 'success',
            'message' => 'Todo updated successfully',
            'data' => $todo
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/todos/{id}",
     *     summary="Delete a todo",
     *     tags={"Todos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Todo deleted successfully"),
     *     @OA\Response(response=404, description="Todo not found")
     * )
     */
    public function destroy(Request $request, $id)
    {
        $todo = $request->user()->todos()->find($id);

        if (!$todo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Todo not found'
            ], 404);
        }

        $todo->delete();

        Cache::forget("todos_user_{$request->user()->id}");

        return response()->json([
            'status' => 'success',
            'message' => 'Todo deleted successfully'
        ]);
    }
}
