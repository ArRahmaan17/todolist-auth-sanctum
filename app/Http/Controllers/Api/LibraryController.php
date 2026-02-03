<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libraries = json_encode(Library::getAllLibraries());
        if ($libraries === '[]') {
            $response = ['status' => false, 'message' => 'Libraries not found', 'data' => null];

            return Response()->json($response, 404);
        }
        $response = ['status' => true, 'message' => 'We found the data', 'data' => json_decode($libraries)];

        return Response()->json($response, 200);
    }

    /**
     * Filter a Library of the resource.
     *
     * @param string filter
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $name = $request->query('name');
        $address = $request->query('address');
        $filter = [
            'name' => $name,
            'address' => $address,
        ];
        if ($name === null || $name === '') {
            $response = ['status' => false, 'message' => 'your credentials is not valid'];

            return Response()->json($response, 401);
        }
        $data = Library::searchLibrary($filter);
        if (json_encode($data) === '[]') {
            $response = ['status' => false, 'message' => 'we not found your library', 'data' => null];

            return Response()->json($response, 404);
        }
        $response = ['status' => true, 'message' => 'we found your library', 'data' => $data];

        return Response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['libraryName' => 'required|alpha', 'libraryPhone' => 'required|numeric', 'libraryAddress' => 'required|alpha', 'libraryEmail' => 'required|email']);
        $data = ['library_name' => $request->libraryName, 'library_address' => $request->libraryAddress, 'library_phone_number' => $request->libraryPhone, 'library_email' => $request->libraryEmail, 'library_owner' => 1];
        $status = Library::storeAccount($data);
        if (! $status) {
            $response = ['status' => $status, 'message' => 'we failed to store your library'];

            return Response()->json($response, 401);
        }
        $response = ['status' => $status, 'message' => 'we successfully stored your library'];

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
        $data = Library::showSpecifiedLibrary($id);
        if ($data == null) {
            $response = ['status' => false, 'message' => 'we failed to find your specified library', 'data' => null];

            return Response()->json($response, 404);
        }
        $response = ['status' => true, 'message' => 'we successfully find your specified library', 'data' => $data];

        return Response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = ['library_name' => $request->libraryName, 'library_address' => $request->libraryAddress, 'library_phone_number' => $request->libraryPhone, 'library_email' => $request->libraryEmail, 'library_owner' => 1];
        $status = Library::updateSpecifiedLibrary($id, $data);
        if (! $status) {
            $response = ['status' => $status, 'message' => 'we failed to updated your library'];

            return Response()->json($response, 401);
        }
        $response = ['status' => $status, 'message' => 'we successfully updated your library'];

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
        $data = Library::destroySpecifiedLibrary($id);
        if (! $data) {
            $response = ['status' => false, 'message' => 'we failed to destroy your specified library'];

            return Response()->json($response, 404);
        }
        $response = ['status' => true, 'message' => 'we successfully to destroy your specified library'];

        return Response()->json($response, 200);
    }
}
