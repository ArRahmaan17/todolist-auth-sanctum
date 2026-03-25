<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::getAllCategories();
        if (! $categories) {
            $response = ['message' => 'No categories found', 'status' => false, 'data' => $categories];

            return Response()->json($response, 404);
        }
        $response = ['message' => 'all categories loaded', 'status' => true, 'data' => $categories];

        return Response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate(['category_name' => 'required|string|max:255']);
        $newCategory = ['category_name' => $request->category_name];
        if (! Category::storeNewCategory($newCategory)) {
            return response()->json([
                'message' => 'failed store new category record',
                'status' => false
            ], 500);
        }
        
        return response()->json([
            'message' => 'successfully store new category record',
            'status' => true
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $specifiedCategory = Category::findSpecifiedRecord($id);
        if (! $specifiedCategory) {
            $response = ['message' => 'failed to find a specified category record', 'status' => false, 'data' => $specifiedCategory];

            return Response()->json($response, 404);
        }
        $response = ['message' => 'successfully to find a specified category record', 'status' => true, 'data' => $specifiedCategory];

        return Response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {}

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $updatedRecord = ['id' => $id, 'category_name' => $request->category_name];
        if (! Category::updateSpecifiedRecord($updatedRecord)) {
            $response = ['message' => 'failed update a specified category record', 'status' => false];

            return Response()->json($response, 401);
        }
        $response = ['message' => 'successfully update a specified category record', 'status' => true];

        return Response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (! Category::destroySpecifiedRecord($id)) {
            $response = ['message' => 'failed delete a specified category record', 'status' => false];

            return Response()->json($response, 401);
        }
        $response = ['message' => 'successfully delete a specified category record', 'status' => true];

        return Response()->json($response, 200);
    }
}
