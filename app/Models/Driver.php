<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Driver extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable =[
        'uuid',
        'name',
        'matricule',
        'birth_date',
        'address',
        'driver_licence',
        'licence_category',
        'exp_date',
        'tel',
        'observation',
        'status',
        'created_by'
    ];

    protected $with = [
        'ActiveVehicle',
        'vehicles',
        'documents',
    ];

    protected $casts = [
        'birth_date' => 'datetime',
        'exp_date' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function ActiveVehicle():HasOne
    {
        return $this->hasOne(Assignation::class, 'driver_id')->latestOfMany();
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Assignation::class, 'driver_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'driver_id');
    }

}
