<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'datetime',
        'area',
        'density',
        'map_id',
        'user_id',
    ];

    public static function store($reques, $id = null)
    {
        $plan = $reques->only(['name', 'type', 'datetime', 'area', 'density', 'map_id']);
        $plan['user_id'] = Auth::id();
        
        $plan = self::updateOrCreate(['id' => $id], $plan);

        return $plan;
    }

    public function instructions():HasMany
    {
        return $this->hasMany(Instruction::class);
    }

    public function map():BelongsTo
    {
        return $this->belongsTo(Map::class);
    }
}