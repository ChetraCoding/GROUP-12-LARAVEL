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
        return response()->json(['success' => true,'data' => $data,],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDroneRequest $request)
    {
        //
        $data = Drone::create($request->only('code', 'battery', 'payload', 'user_id'));
        return Response()->json(['success' => true,'message' => 'Create drone is successfully.','data' => $data], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $data = Drone::find($id);
        if ($data){
            $data = new ShowDroneResource($data);
            return Response()->json(['success' => true,'data' => $data], 200);
        }
        return response()->json(['success' => false,'message' => 'Drone ID not found.']);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDroneRequest $request, $id)
    {
        //
        $data = Drone::find($id);
        if ($data){
            $data->update($request->only('code', 'battery', 'payload', 'user_id'));
            return Response()->json(['success' => true,'message' => 'Update drone is successfully.','data' => $data], 200);
        }
        return response()->json(['success' => false,'message' => 'Drone ID not found.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $data = Drone::find($id);
        if ($data){
            $data->delete();
            return Response()->json(['success' => true,'message' => 'Delete drone successfully.',], 200);
        }
        return response()->json(['success' => false,'message' => 'Drone ID not found.']);

    }
}
