<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Map extends Model
{
    use HasFactory;
    protected $fillable = [
        'farm_id',
        'drone_id',
        'image',
    ];

    public static function store($reques, $id = null)
    {
        $map = $reques->only(['farm_id', 'drone_id', 'image']);
        
        $map = self::updateOrCreate(['id' => $id], $map);

        return $map;
    }

    // All maps from an authorized user
    public static function listOfMaps()
    {
        $maps = collect();
        Auth::user()->drones->map(function ($drone) use ($maps) {
            $drone->maps->map(function ($map) use ($maps) {
                $maps->push($map);
            });
        });
        return $maps;
    }
    
    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

    public function drone(): BelongsTo
    {
        return $this->belongsTo(Drone::class);
    }
}
