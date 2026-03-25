<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $allBooks = Books::getAllBooks();
        if ($allBooks == []) {
            $response = ['message' => 'books not found', 'status' => false, 'data' => $allBooks];

            return Response()->json($response, 404);
        }
        $response = ['message' => 'successfully founding all books', 'status' => true, 'data' => $allBooks];

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
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|string',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $newBook = $request->only(['title', 'synopsis', 'quantity', 'status', 'author_id', 'category_id']);

        if (! Books::create($newBook)) {
            return response()->json([
                'message' => 'books cant be saved',
                'status' => false,
            ], 500);
        }

        return response()->json([
            'message' => 'successfully new books record',
            'status' => true,
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
        $book = Books::find($id);
        if (! $book) {
            return response()->json([
                'message' => 'book not found',
                'status' => false,
            ], 404);
        }

        return response()->json([
            'message' => 'successfully found the book',
            'status' => true,
            'data' => $book,
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
        $book = Books::find($id);
        if (! $book) {
            return response()->json([
                'message' => 'book not found',
                'status' => false,
            ], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'synopsis' => 'sometimes|required|string',
            'quantity' => 'sometimes|required|integer|min:0',
            'status' => 'sometimes|required|string',
            'author_id' => 'sometimes|required|exists:authors,id',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        if (! $book->update($request->all())) {
            return response()->json([
                'message' => 'failed to update the book',
                'status' => false,
            ], 500);
        }

        return response()->json([
            'message' => 'successfully updated the book',
            'status' => true,
            'data' => $book,
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
        $book = Books::find($id);
        if (! $book) {
            return response()->json([
                'message' => 'book not found',
                'status' => false,
            ], 404);
        }

        if (! $book->delete()) {
            return response()->json([
                'message' => 'failed to delete the book',
                'status' => false,
            ], 500);
        }

        return response()->json([
            'message' => 'successfully deleted the book',
            'status' => true,
        ], 200);
    }
}
