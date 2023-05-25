<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMapRequest;
use App\Models\Farm;
use App\Models\Map;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maps = Auth::user()->Maps;
        return response()->json(['success' => true, 'message' => 'Get maps are successfully.', 'maps' => $maps], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMapRequest $request)
    {
        $farm = Auth::user()->farms->where('id', $request->farm_id)->first();
        if ($farm) {
            $maps = Map::create([
                'farm_id' => request('farm_id'),
                'drone_id' => request('drone_id'),
                'image' => Request('image'),
            ]);
            return response()->json(['success' => true, 'message' => 'Get maps are successfully.', 'data' => $maps], 200);
        }
        return response()->json(['success' => false, 'message' => 'Farm id is not found.'], 404);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $farm = Auth::user()->farms->where('id', $id)->first();
        if ($farm) {
            $mapImage = ['image' => $farm->maps->first()->image];
            return response()->json(['success' => true, 'message' => 'Get map is successfully.', 'data' => $mapImage], 200);
        }
        return response()->json(['success' => false, 'message' => 'Farm id is not found.'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMapRequest $request, $id)
    {
        $farm = Auth::user()->farms->where('id', $request->farm_id)->first();
        $maps = Map::find($id);
        if ($farm) {
            if ($maps) {
                $maps->update([
                    'farm_id' => request('farm_id'),
                    'drone_id' => request('drone_id'),
                    'image' => Request('image'),
                ]);
                return response()->json(['success' => true, 'message' => 'Create map is successfully.', 'data' => $maps], 200);
            }
            return response()->json(['success' => false, 'message' => 'Map id is not found.'], 404);
        }
        return response()->json(['success' => false, 'message' => 'Farm id is not found.'], 404);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $map = Auth::user()->farms;
        return $map;
        dd($map);
        if ($map) {
            $map->delete();
            return response()->json(['success' => true, 'message' => 'Delete map is successfully.'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Farm id is not found.'], 404);
    }
}
