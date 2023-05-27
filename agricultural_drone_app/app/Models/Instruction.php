<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Instruction extends Model
{
    use HasFactory;
    protected $fillable = [
        'run_mode',
        'speed',
        'lat',
        'lng',
        'drone_id',
        'plan_id',
    ];

    public static function store($reques, $id = null)
    {
        $instruction = $reques->only(['run_mode', 'speed', 'lat', 'lng', 'drone_id', 'plan_id']);
        
        $instruction = self::updateOrCreate(['id' => $id], $instruction);

        return $instruction;
    }

    // All instructions from an authorized user
    public static function listOfInstructions() 
    {
        $instructions = collect();
        Auth::user()->drones->map(function ($drone) use ($instructions) {
            $drone->instructions->map(function ($instruction) use ($instructions) {
                $instructions->push($instruction);
            });
        });
        return $instructions;
    }

    public function drone(): BelongsTo
    {
        return $this->belongsTo(Drone::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
