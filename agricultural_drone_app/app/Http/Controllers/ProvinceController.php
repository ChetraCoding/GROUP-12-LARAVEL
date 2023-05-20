<?php

namespace App\Http\Controllers;

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
        //
        $provinces = Province::all();
        $provinces = ShowProvinceResource::collection($provinces);
        return Response()->json([
            'success' => true,
            'provinces' => $provinces,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:provinces,name',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $provinces = Province::create($validator->validated());
        return Response()->json([
            'success' => true,
            'message' => 'create province successfully',
            'provinces' => $provinces
        ], 200);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $provinces = Province::find($id);
        $provinces = new ShowProvinceResource($provinces);
        return Response()->json([
            'success' => true,
            'provinces' => $provinces,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:provinces,name',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $provinces = Province::find($id)->update($validator->validated());
        return Response()->json([
            'success' => true,
            'message' => 'update province successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $province = Province::find($id)->delete();
        return Response()->json([
            'success' => true,
            'message' => 'delete province successfully',
        ], 200);
    }
}
