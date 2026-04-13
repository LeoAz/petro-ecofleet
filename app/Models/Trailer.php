<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class Trailer extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'registration',
        'code_trailer',
        'brand_id',
        'pattern_id',
        'type',
        'empty_weight',
        'capacity',
        'axels',
        'unit',
        'state',
        'usage',
        'user_id',
        'acquisition_amount',
        'commissioning_date',
        'status',
        'is_linked',
        'user_id',
        'created_by'
    ];

    protected $casts = [
        'commissioning_date' => 'datetime',
        'is_linked' => 'boolean'
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function setRegistrationAttribute($value)
    {
        $this->attributes['registration'] = Str::upper($value);
    }

    public function setCodeTrailerAttribute($value)
    {
        $this->attributes['code_trailer'] = Str::upper($value);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'trailer_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function pattern(): BelongsTo
    {
        return $this->belongsTo(Pattern::class);
    }

    public function vehicles():HasMany
    {
        return $this->hasMany(Link::class, 'trailer_id');

    }

    public function activeVehicle():HasOne
    {
        return $this->hasOne(Link::class, 'trailer_id')->latestOfMany();
    }

}
