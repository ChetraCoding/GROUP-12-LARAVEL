<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMapRequest;
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
        $maps = collect();
        Auth::user()->drones->map(function ($drone) use ($maps) {
            $drone->maps->map(function ($map) use ($maps) {
                $maps->push($map);
            });
        });
        return response()->json(['success' => true, 'message' => 'Get maps are successfully.', 'data' => $maps], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMapRequest $request)
    {
        $farm = Auth::user()->farms->find(request('farm_id'));
        $drone = Auth::user()->drones->find(request('drone_id'));
        if ($farm && $drone) {
            $map = Map::create($request->only('farm_id', 'drone_id', 'image'));
            return response()->json(['success' => true, 'message' => 'Create map is successfully.', 'data' => $map], 200);
        }
        return response()->json(['success' => false, 'message' => 'Farm id or drone id is invalid.'], 404);
    }

    /**
     * Display the specified resource.
     */
    public function showMapBy($farm_id, $map_id)
    {
        $farm = Auth::user()->farms->find($farm_id);
        if ($farm) {
            $map = $farm->maps->find($map_id);
            if ($map) {
                return response()->json(['success' => true, 'message' => 'Get map is successfully.', 'data' => $map], 200);
            }
        }
        return response()->json(['success' => false, 'message' => 'Farm id or map id is invalid.'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $map = Map::find($id);
        if ($map) {
            $farm = Auth::user()->farms->find(request('farm_id'));
            if ($farm) {
                $map->update($request->only('farm_id', 'drone_id', 'image'));
                return response()->json(['success' => true, 'message' => 'Update map is successfully.', 'data' => $map], 200);
            }
            return response()->json(['success' => false, 'message' => 'Farm id is invalid.'], 404);
        }
        return response()->json(['success' => false, 'message' => 'Map id is not found.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyMapBy($farm_id, $map_id)
    {
        $farm = Auth::user()->farms->find($farm_id);
        if ($farm) {
            $map = $farm->maps->find($map_id);
            if ($map) {
                $map->delete();
                return response()->json(['success' => true, 'message' => 'Delete map is successfully.'], 200);
            }
        }
        return response()->json(['success' => false, 'message' => 'Farm id or map id is invalid.'], 404);
    }
}