<?php

namespace App\Models;

use App\Enums\Fleet\AssignationStatus;
use App\Enums\Fleet\LinkStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'registration',
        'chassis',
        'code_vehicle',
        'fuel',
        'power',
        'brand_id',
        'state',
        'user_id',
        'usage',
        'pattern_id',
        'type',
        'empty_weight',
        'capacity',
        'unit',
        'consumption',
        'number_places',
        'mileage',
        'commissioning_date',
        'acquisition_amount',
        'has_driver',
        'is_linked',
        'status',
        'created_by',
        'is_tier',
        'driver',
        'trailer',
    ];

    protected $casts = [
        'commissioning_date' => 'datetime',
        'has_driver' => 'boolean',
        'is_linked' => 'boolean',
        'is_tier' => 'boolean'
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function setRegistrationAttribute($value)
    {
        $this->attributes['registration'] = Str::upper($value);
    }

    public function setChassisAttribute($value)
    {
        $this->attributes['chassis'] = Str::upper($value);
    }

    public function setCodeVehicleAttribute($value)
    {
        $this->attributes['code_vehicle'] = Str::upper($value);
    }


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function pattern(): BelongsTo
    {
        return $this->belongsTo(Pattern::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'vehicle_id');
    }

    public function activeDriver():HasOne
    {
        return $this->hasOne(Assignation::class, 'vehicle_id')
            ->latestOfMany()
            ->where('status', LinkStatus::Active);
    }

    public function drivers(): HasMany
    {
        return $this->hasMany(Assignation::class, 'vehicle_id');
    }

    public function garages(): HasMany
    {
        return $this->hasMany(Garage::class, 'vehicle_id');
    }

    public function accidents(): HasMany
    {
        return $this->hasMany(Accident::class, 'vehicle_id');
    }

    public function reforms(): HasMany
    {
        return $this->hasMany(Reform::class, 'vehicle_id');
    }

    public function repairs(): HasMany
    {
        return $this->hasMany(Repair::class, 'vehicle_id');
    }

    public function activeTrailer():HasOne
    {
        return $this->hasOne(Link::class, 'vehicle_id')
            ->latestOfMany()
            ->where('status', AssignationStatus::Active );
    }

    public function trailers():HasMany
    {
        return $this->hasMany(Link::class, 'vehicle_id');
    }

}
