<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\StoreProvonceIdRequest;
use App\Http\Resources\ShowProvinceResource;
use App\Models\Province;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinces = Province::all();
        $provinces = ShowProvinceResource::collection($provinces);
        return Response()->json(['success' => true, 'message' => 'Get all provinces are successfully.', 'data' => $provinces], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProvinceRequest $request)
    {
        $provinces = Province::create($request->only('name'));
        return Response()->json(['success' => true, 'message' => 'Create province is successfully.', 'data' => $provinces], 200);
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $province = Province::find($id);
        if ($province) {
            $province = new ShowProvinceResource($province);
            return Response()->json(['success' => true, 'message' => 'Get province is successfully.', 'data' => $province ], 200);
        }
        return Response()->json(['success' => false, 'message' => 'Province id is not found.'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProvinceRequest $request, $id)
    {
        $province = Province::find($id);
        if ($province) {
            $province->update($request->only('name'));
            return Response()->json(['success' => true, 'message' => 'Update province is successfully.', 'data'=> $province], 200);
        }
        return Response()->json(['success' => false, 'message' => 'Province id is not found.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $province = Province::find($id);
        if ($province) {
            $province->delete();
            return Response()->json(['success' => true, 'message' => 'Delete province is successfully.',], 200);
        }
        return Response()->json(['success' => false, 'message' => 'Province id is not found.'], 404);
    }
}
