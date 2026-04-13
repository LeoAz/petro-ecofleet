<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pattern extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'user_id',
        'created_by'
    ];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'pattern_id');
    }

    public function trailers(): HasMany
    {
        return $this->hasMany(Trailer::class, 'pattern_id');
    }
}
