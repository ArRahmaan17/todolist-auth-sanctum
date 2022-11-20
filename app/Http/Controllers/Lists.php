<?php

namespace App\Http\Controllers;

use App\Models\lists as ModelsLists;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class Lists extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/api/show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        $data = [
            'name' => $request->name
        ];
        if (!ModelsLists::storeList($data)) {
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = ModelsLists::showAllList();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $list = ModelsLists::specificList($request->id);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required']);
        $updatedList = ['id' => $request->id, 'name' => $request->name];
        if (!ModelsLists::updateSpecificList($updatedList)) {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!ModelsLists::removeList($request->id)) {
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
    }
}
