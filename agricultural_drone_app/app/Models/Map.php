<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Map extends Model
{
    use HasFactory;
    protected $fillable = [
        'farm_id',
        'drone_id',
        'image',
    ];
    
    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

    public function drone(): BelongsTo
    {
        return $this->belongsTo(Drone::class);
    }
}
