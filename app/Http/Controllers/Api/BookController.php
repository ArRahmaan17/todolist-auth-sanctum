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
        $newBook = ['title' => $request->title, 'synopsis' => $request->synopsis, 'quantity' => $request->quantity, 'status' => $request->status, 'author_id' => $request->author, 'category_id' => $request->category];
        if (! Books::storeNewBook($newBook)) {
            $response = ['message' => 'books cant be saved', 'status' => false];

            return Response()->json($response, 404);
        }
        $response = ['message' => 'successfully new books record', 'status' => true];

        return Response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
