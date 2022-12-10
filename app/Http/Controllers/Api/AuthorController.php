<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Authors;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authorsData = Authors::getAllAuthors();
        if (json_encode($authorsData) === "[]") {
            $response = [
                'status' => false,
                'message' => "we failed to found the authors",
                'data' => null
            ];
            return Response()->json($response, 404);
        }
        $response = [
            'status' => true,
            'message' => "we successfully found the authors",
            'data' => $authorsData
        ];
        return Response()->json($response, 200);
    }

    /**
     * filtering the author.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorRequest $request)
    {
        if (!Authors::createAuthors($request->authorsAccount())) {
            $response = ['status' => false, 'message' => 'we failed to create the author'];
            return Response()->json($response, 401);
        }
        $response = ['status' => true, 'message' => 'we successfully create the author'];
        return Response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataAuthor = Authors::showSpecifiedAuthors($id);
        if ($dataAuthor == null) {
            $response = ['status' => false, 'message' => 'we failed to find the author', 'data' => null];
            return Response()->json($response, 401);
        }
        $response = ['status' => true, 'message' => 'we successfully find the author', 'data' => $dataAuthor];
        return Response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorRequest $request, $id)
    {
        if (!Authors::updateAuthors($request->authorsAccount(), $id)) {
            $response = ['status' => false, 'message' => 'we failed to update the author'];
            return Response()->json($response, 401);
        }
        $response = ['status' => true, 'message' => 'we successfully to update the author'];
        return Response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Authors::deleteAuthors($id)) {
            $response = ['status' => false, 'message' => 'we failed to delete the author'];
            return Response()->json($response, 401);
        }
        $response = ['status' => true, 'message' => 'we successfully to delete the author'];
        return Response()->json($response, 200);
    }
}
