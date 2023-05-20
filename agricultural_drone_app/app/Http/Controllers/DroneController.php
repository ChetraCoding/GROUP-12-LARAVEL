<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDroneRequest;
use App\Http\Resources\ShowDroneResource;
use App\Models\Drone;
use Illuminate\Http\Request;

class DroneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Drone::all();
        $data = ShowDroneResource::collection($data);
        return response()->json([
            'success' => true,
            'data' => $data,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDroneRequest $request)
    {
        //
        $drone = $request->only('code', 'battery', 'payload', 'user_id');
        $data = Drone::create($drone);
        return Response()->json([
            'success' => true,
            'message' => 'create drone successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $data = Drone::find($id);
        if ($data === null){
            return 'Drone id is not found';
        }
        $data = new ShowDroneResource($data);
        return Response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDroneRequest $request, $id)
    {
        //
        $data = Drone::find($id);
        if ($data === null){
            return response()->json([
                'success' => false,
                'message' => 'Drone ID not found'
            ]);
        }
        $drone = $request->only('code', 'battery', 'payload', 'user_id');
        $data->update($drone);
        return Response()->json([
            'success' => true,
            'message' => 'update drone successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $data = Drone::find($id);
        if ($data === null){
            return response()->json([
                'success' => false,
                'message' => 'Drone ID not found'
            ]);
        }
        $data->delete();
        return Response()->json([
            'success' => true,
            'message' => 'delete drone successfully',
        ], 200);

    }
}
