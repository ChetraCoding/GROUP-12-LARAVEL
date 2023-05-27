<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Drone extends Model
{
    use HasFactory;
    protected $fillable =[
        'code',
        'battery',
        'payload',
        'lat',
        'lng',
        'user_id'
    ];

    public static function store($reques, $id = null)
    {
        $drone = $reques->only(['code', 'battery', 'payload', 'lat', 'lng']);
        $drone['user_id'] = Auth::id();
        
        $drone = self::updateOrCreate(['id' => $id], $drone);

        return $drone;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function maps():HasMany
    {
        return $this->hasMany(Map::class);
    }

    public function instructions():HasMany
    {
        return $this->hasMany(Instruction::class);
    }
}
