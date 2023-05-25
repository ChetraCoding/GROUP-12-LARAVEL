<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFarmRequest;
use App\Models\Farm;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farms = Auth::user()->farms;
        return response()->json(['success' => true, 'message' => 'Get farms are successfully.', 'data' => $farms], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFarmRequest $request)
    {
        $farm = Farm::create([
            'name' => request('name'),
            'province_id' => request('province_id'),
            'user_id' => Auth::id()
        ]);
        return response()->json(['success' => true, 'message' => 'Create farm is successfully.', 'data' => $farm], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $farm = Auth::user()->farms->find($id);
        if ($farm) {
            return response()->json(['success' => true, 'message' => 'Get farm is successfully.', 'data' => $farm], 200);
        }
        return response()->json(['success' => false, 'message' => 'Farm id is not found.'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFarmRequest $request, $id)
    {
        $farm = Auth::user()->farms->find($id);
        if ($farm) {
            $farm->update([
                'name' => request('name'),
                'province_id' => request('province_id'),
                'user_id' => $farm->user_id
            ]);
            return response()->json(['success' => true, 'message' => 'Update farm is successfully.', 'data' => $farm], 200);
        }
        return response()->json(['success' => false, 'message' => 'Farm id is not found.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $farm = Auth::user()->farms->find($id);
        if ($farm) {
            $farm->delete();
            return response()->json(['success' => true, 'message' => 'Delete farm is successfully.'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Farm id is not found.'], 404);
    }
}
