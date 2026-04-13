<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'name',
        'user_id'
    ];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'brand_id');
    }

    public function trailers(): HasMany
    {
        return $this->hasMany(Trailer::class, 'brand_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
