<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Authors;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $authorsData = Authors::getAllAuthors();
        if ($authorsData->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'we failed to found the authors',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'we successfully found the authors',
            'data' => $authorsData,
        ], 200);
    }

    /**
     * filtering the author.
     *
     * @return Response
     */
    public function filter(Request $request)
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
        $request->validate([
            'authors_name' => 'required|string|max:255',
        ]);

        if (! Authors::createAuthors($request->only('authors_name'))) {
            return response()->json([
                'status' => false,
                'message' => 'we failed to create the author',
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'we successfully create the author',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $dataAuthor = Authors::showSpecifiedAuthors($id);
        if ($dataAuthor == null) {
            return response()->json([
                'status' => false,
                'message' => 'we failed to find the author',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'we successfully find the author',
            'data' => $dataAuthor,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $author = Authors::showSpecifiedAuthors($id);
        if (! $author) {
            return response()->json([
                'status' => false,
                'message' => 'author not found',
            ], 404);
        }

        $request->validate([
            'authors_name' => 'required|string|max:255',
        ]);

        if (! $author->update($request->only('authors_name'))) {
            return response()->json([
                'status' => false,
                'message' => 'we failed to update the author',
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'we successfully to update the author',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $author = Authors::showSpecifiedAuthors($id);
        if (! $author) {
            return response()->json([
                'status' => false,
                'message' => 'author not found',
            ], 404);
        }

        if (! $author->delete()) {
            return response()->json([
                'status' => false,
                'message' => 'we failed to delete the author',
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'we successfully to delete the author',
        ], 200);
    }
}
