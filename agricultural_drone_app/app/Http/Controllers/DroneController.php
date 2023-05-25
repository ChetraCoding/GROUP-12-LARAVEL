<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDroneRequest;
use App\Http\Resources\ShowDroneResource;
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
        $drones = ShowDroneResource::collection($drones);
        return response()->json(['success' => true, 'message' => 'Get all drones are successfully.', 'data' => $drones],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDroneRequest $request)
    {
        $drone = Drone::create([
            'code'=> request('code'),
            'battery'=> request('battery'),
            'payload'=> request('payload'),
            'lat'=> request('lat'),
            'lng'=> request('lng'),
            'user_id'=> Auth::id()
        ]);
        return Response()->json(['success' => true,'message' => 'Create drone is successfully.','data' => $drone], 200);
    }

    /**
     * Search code for drones.
     */
    public function search($code)
    {
        $drones = Drone::where([['user_id', Auth::id()], ['code', 'like', "%{$code}%"]])->get();
        $drones = ShowDroneResource::collection($drones);
        return Response()->json(['success' => true, 'message' => 'Search drones are successfully.', 'data' => $drones], 200);
    }

    /**
     * Search code for drones.
     */
    public function getLocationBy($id)
    {
        $drone = Auth::user()->drones->find($id);
        if ($drone){
            $location = [
                'location'=> [
                    'lat'=> $drone->lat,
                    'lng'=> $drone->lng,
                ]
            ];
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
     * Update the specified resource in storage.
     */
    public function update(StoreDroneRequest $request, $id)
    {
        $drone = Auth::user()->drones->find($id);
        if ($drone){
            $drone->update([
                'code'=> request('code'),
                'battery'=> request('battery'),
                'payload'=> request('payload'),
                'lat'=> request('lat'),
                'lng'=> request('lng'),
                'user_id'=> $drone->user_id
            ]);
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
