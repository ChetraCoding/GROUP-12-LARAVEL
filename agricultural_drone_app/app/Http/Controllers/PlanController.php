<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlanRequest;
use App\Http\Resources\PlanResource;
use App\Http\Resources\ShowPlanResource;
use App\Models\Map;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Auth::user()->plans;
        $plans = PlanResource::collection($plans);
        return Response()->json(['success' => true, 'message' => 'Get all plans are successfully.', 'data' => $plans], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanRequest $request)
    {
        $checkMap = Map::listOfMaps()->where('id', request('map_id'))->first();
        if ($checkMap) {
            $plan = Plan::store($request);
            return Response()->json(['success' => true, 'message' => 'Create plan is successfully.', 'data'=> $plan], 200);
        }
        return Response()->json(['success' => false, 'message' => 'Select map id is invalid.'], 404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plan = Auth::user()->plans->find($id);
        if ($plan) {
            $plan = new ShowPlanResource($plan);
            return Response()->json(['success' => true, 'message' => 'Get plan is successfully.', 'data' => $plan], 200);
        }
        return Response()->json(['success' => false, 'message' => 'Plan id is not found.'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePlanRequest $request, string $id)
    {
        $checkPlan = Auth::user()->plans->contains($id);
        if ($checkPlan) {
            $checkMap = Map::listOfMaps()->where('id', request('map_id'))->first();
            if ($checkMap) {
                $plan = Plan::store($request, $id);
                return Response()->json(['success' => true, 'message' => 'Update plan is successfully.', 'data'=> $plan], 200);
            }
            return Response()->json(['success' => false, 'message' => 'Select map id is invalid.'], 404);
        }
        return Response()->json(['success' => false, 'message' => 'Plan id is not found.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan = Auth::user()->plans->find($id);
        if ($plan) {
            $plan->delete();
            return Response()->json(['success' => true, 'message' => 'Delete plan is successfully.'], 200);
        }
        return Response()->json(['success' => false, 'message' => 'Plan id is not found.'], 404);
    }
}