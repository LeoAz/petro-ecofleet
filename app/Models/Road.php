<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Road extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_point',
        'end_point',
        'mileage',
        'fuel_quantity',
        'duration'
    ];

    protected $appends = [ 'full_description'];

    /**
     * @return HasMany
     */
    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class, 'road_id');
    }

    /**
     * @return string
     */
    public function getFullDescriptionAttribute(): string
    {
        return "{$this->start_point} - {$this->end_point}";
    }
}
