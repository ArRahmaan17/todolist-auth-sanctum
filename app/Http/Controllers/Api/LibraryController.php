<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $libraries = Library::getAllLibraries();
        if ($libraries->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Libraries not found',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'We found the data',
            'data' => $libraries,
        ], 200);
    }

    /**
     * Filter a Library of the resource.
     *
     * @param string filter
     * @return Response
     */
    public function filter(Request $request)
    {
        $name = $request->query('name');
        $address = $request->query('address');

        if (empty($name) && empty($address)) {
            return response()->json([
                'status' => false,
                'message' => 'Search criteria required',
            ], 400);
        }

        $filter = [
            'name' => $name ?? '',
            'address' => $address ?? '',
        ];

        $data = Library::searchLibrary($filter);

        if ($data->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'we not found your library',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'we found your library',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'libraryName' => 'required|string|max:255',
            'libraryPhone' => 'required|string|max:20',
            'libraryAddress' => 'required|string|max:255',
            'libraryEmail' => 'required|email|max:255',
        ]);

        $data = [
            'library_name' => $request->libraryName,
            'library_address' => $request->libraryAddress,
            'library_phone_number' => $request->libraryPhone,
            'library_email' => $request->libraryEmail,
            'library_owner' => $request->user()->id, // Use current user
        ];

        if (! Library::storeAccount($data)) {
            return response()->json([
                'status' => false,
                'message' => 'we failed to store your library',
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'we successfully stored your library',
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
        $data = Library::showSpecifiedLibrary($id);
        if ($data == null) {
            return response()->json([
                'status' => false,
                'message' => 'we failed to find your specified library',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'we successfully find your specified library',
            'data' => $data,
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
        $request->validate([
            'libraryName' => 'sometimes|required|string|max:255',
            'libraryPhone' => 'sometimes|required|string|max:20',
            'libraryAddress' => 'sometimes|required|string|max:255',
            'libraryEmail' => 'sometimes|required|email|max:255',
        ]);

        $data = $request->only(['libraryName', 'libraryAddress', 'libraryPhone', 'libraryEmail']);
        // Map to DB columns
        $dbData = [];
        if (isset($data['libraryName'])) {
            $dbData['library_name'] = $data['libraryName'];
        }
        if (isset($data['libraryAddress'])) {
            $dbData['library_address'] = $data['libraryAddress'];
        }
        if (isset($data['libraryPhone'])) {
            $dbData['library_phone_number'] = $data['libraryPhone'];
        }
        if (isset($data['libraryEmail'])) {
            $dbData['library_email'] = $data['libraryEmail'];
        }

        if (! Library::updateSpecifiedLibrary($id, $dbData)) {
            return response()->json([
                'status' => false,
                'message' => 'we failed to updated your library',
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'we successfully updated your library',
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
        if (! Library::destroySpecifiedLibrary($id)) {
            return response()->json([
                'status' => false,
                'message' => 'we failed to destroy your specified library',
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'we successfully to destroy your specified library',
        ], 200);
    }
}
