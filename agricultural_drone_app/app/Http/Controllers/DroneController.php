<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDroneRequest;
use App\Http\Requests\StoreUpdateInstructionRequest;
use App\Http\Resources\DroneResource;
use App\Http\Resources\LocationResource;
use App\Http\Resources\ShowDroneResource;
use App\Http\Resources\ShowInstructionResource;
use App\Models\Drone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DroneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drones = Auth::user()->drones;
        $drones = DroneResource::collection($drones);
        return response()->json(['success' => true, 'message' => 'Get all drones are successfully.', 'data' => $drones],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDroneRequest $request)
    {
        $drone = Drone::store($request);
        return Response()->json(['success' => true,'message' => 'Create drone is successfully.','data' => $drone], 200);
    }

    /**
     * Get current location of drone (latitude and longitude).
     */
    public function getLocationBy($drone_id)
    {
        $drone = Auth::user()->drones->find($drone_id);
        if ($drone){
            $location = new LocationResource($drone);
            return Response()->json(['success' => true, 'message' => 'Get drone is successfully.', 'data' => $location], 200);
        }
        return response()->json(['success' => false,'message' => 'Drone id is not found.'], 404);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $drone = Auth::user()->drones->find($id);
        if ($drone){
            $drone = new ShowDroneResource($drone);
            return Response()->json(['success' => true, 'message' => 'Get drone is successfully.', 'data' => $drone], 200);
        }
        return response()->json(['success' => false,'message' => 'Drone id is not found.'], 404);
    }

    /**
     * Update the drone's instruction by the given drone and instruction ID.
     */
    public function updateDroneInstruction($drone_id, $instruction_id, StoreUpdateInstructionRequest $request) {
        $drone = Auth::user()->drones->find($drone_id);
        if ($drone) {
            $instruction = $drone->instructions->find($instruction_id);
            if ($instruction) {
                $instruction->update($request->only('run_mode', 'speed', 'lat', 'lng'));
                $instruction = new ShowInstructionResource($instruction);
                return Response()->json(['success' => true, 'message' => "Update drone's instruction is successfully.", 'data'=> $instruction], 200);
            }
            return response()->json(['success' => false,'message' => 'Instruction id is not found.'], 404);
        }
        return response()->json(['success' => false,'message' => 'Drone id is not found.'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDroneRequest $request, $id)
    {
        $checkDrone = Auth::user()->drones->find($id);
        if ($checkDrone){
            $drone = Drone::store($request, $id);
            return Response()->json(['success' => true,'message' => 'Update drone is successfully.','data' => $drone], 200);
        }
        return response()->json(['success' => false,'message' => 'Drone id is not found.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $drone = Auth::user()->drones->find($id);
        if ($drone){
            $drone->delete();
            return Response()->json(['success' => true,'message' => 'Delete drone is successfully.',], 200);
        }
        return response()->json(['success' => false,'message' => 'Drone id is not found.'], 404);
    }
}