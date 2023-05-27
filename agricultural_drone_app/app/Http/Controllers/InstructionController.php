<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstructionRequest;
use App\Http\Resources\InstructionResource;
use App\Http\Resources\ShowInstructionResource;
use App\Models\Instruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructions = Instruction::listOfInstructions();
        $instructions = InstructionResource::collection($instructions);
        return response()->json(['success' => true, 'message' => 'Get all instructions are successfully.', 'data' => $instructions], 200);
    }

    /**
     * Display all instructions by the given drone ID.
     */
    public function getInstructionsBy($drone_id) {
        $drone = Auth::user()->drones->find($drone_id);
        if ($drone) {
            $instructions = ShowInstructionResource::collection($drone->instructions);
            return Response()->json(['success' => true, 'message' => "Get all drone's instructions are successfully.", 'data'=> $instructions], 200);
        }
        return response()->json(['success' => false,'message' => 'Drone id is not found.'], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructionRequest $request)
    {
        $checkPlan = Auth::user()->plans->contains(request('plan_id'));
        $checkDrone = Auth::user()->drones->contains(request('drone_id'));
        if ($checkPlan) {
            if ($checkDrone) {
                $instruction = Instruction::store($request);
                return Response()->json(['success' => true, 'message' => 'Create instruction is successfully.', 'data'=> $instruction], 200);
            }
            return Response()->json(['success' => false, 'message' => 'Select drone id is invalid.'], 404);
        }
        return Response()->json(['success' => false, 'message' => 'Select plan id is invalid.'], 404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $instruction = Instruction::listOfInstructions()->where('id', $id)->first();
        if ($instruction) {
            $instruction = new ShowInstructionResource($instruction);
            return Response()->json(['success' => true, 'message' => 'Get instruction is successfully.', 'data' => $instruction], 200);
        }
        return Response()->json(['success' => false, 'message' => 'Instruction id is not found.'], 404);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(StoreInstructionRequest $request, string $id)
    {
        $checkInstruction = Instruction::listOfInstructions()->where('id', $id)->first();
        if ($checkInstruction) {
            $checkPlan = Auth::user()->plans->contains(request('plan_id'));
            $checkDrone = Auth::user()->drones->contains(request('drone_id'));
            if ($checkPlan) {
                if ($checkDrone) {
                    $instruction = Instruction::store($request, $id);
                    return Response()->json(['success' => true, 'message' => 'Update instruction is successfully.', 'data'=> $instruction], 200);
                }
                return Response()->json(['success' => false, 'message' => 'Select drone id is invalid.'], 404);
            }
            return Response()->json(['success' => false, 'message' => 'Select plan id is invalid.'], 404);
        }
        return Response()->json(['success' => false, 'message' => 'Instruction id is not found.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $instruction = Instruction::listOfInstructions()->where('id', $id)->first();
        if ($instruction) {
            $instruction->delete();
            return Response()->json(['success' => true, 'message' => 'Delete instruction is successfully.'], 200);
        }
        return Response()->json(['success' => false, 'message' => 'Instruction id is not found.'], 404);
    }
}
