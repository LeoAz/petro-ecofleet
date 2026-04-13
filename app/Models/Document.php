<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'label',
        'type',
        'provider',
        'amount',
        'delivery_date',
        'exp_date',
        'vehicle_id',
        'driver_id',
        'trailer_id',
        'status'
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * @var string[]
     */
    protected $casts = [
        'delivery_date' => 'datetime',
        'exp_date' => 'datetime'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function trailer()
    {
        return $this->belongsTo(Trailer::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
