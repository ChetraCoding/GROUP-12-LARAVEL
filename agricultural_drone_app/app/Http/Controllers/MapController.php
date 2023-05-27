<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMapRequest;
use App\Http\Resources\MapResource;
use App\Http\Resources\ShowMapResource;
use App\Models\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maps = Map::listOfMaps();
        $maps = MapResource::collection($maps);
        return response()->json(['success' => true, 'message' => 'Get all maps are successfully.', 'data' => $maps], 200);
    }

    /**
     * Display all maps by the given farm ID.
     */
    public function getMapsBy($farm_id)
    {
        $farm = Auth::user()->farms->find($farm_id);
        if ($farm) {
            $maps = MapResource::collection($farm->maps);
            return response()->json(['success' => true, 'message' => 'Get all maps are successfully.', 'data' => $maps], 200);
        }
        return response()->json(['success' => false, 'message' => 'Farm id is not found.'], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMapRequest $request)
    {
        $checkFarm = Auth::user()->farms->find(request('farm_id'));
        $checkDrone = Auth::user()->drones->find(request('drone_id'));
        if ($checkFarm) {
            if ($checkDrone) {
                $map = Map::store($request);
                return response()->json(['success' => true, 'message' => 'Create map is successfully.', 'data' => $map], 200);
            }
            return response()->json(['success' => false, 'message' => 'Select drone id is invalid.'], 404);
        }
        return response()->json(['success' => false, 'message' => 'Select farm id is invalid.'], 404);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $map = Map::listOfMaps()->where('id', $id)->first();
        if ($map) {
            $map = new ShowMapResource($map);
            return response()->json(['success' => true, 'message' => 'Get map is successfully.', 'data' => $map], 200);
        }
        return response()->json(['success' => false, 'message' => 'Map id is not found.'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $checkMap = Map::listOfMaps()->where('id', $id)->first();
        if ($checkMap) {
            $checkFarm = Auth::user()->farms->find(request('farm_id'));
            if ($checkFarm) {
                $map = Map::store($request, $id);
                return response()->json(['success' => true, 'message' => 'Update map is successfully.', 'data' => $map], 200);
            }
            return response()->json(['success' => false, 'message' => 'Select farm id is invalid.'], 404);
        }
        return response()->json(['success' => false, 'message' => 'Map id is not found.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $map = Map::listOfMaps()->where('id', $id)->first();
        if ($map) {
            $map->delete();
            return response()->json(['success' => true, 'message' => 'Delete map is successfully.'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Map id is not found.'], 404);
    }
}