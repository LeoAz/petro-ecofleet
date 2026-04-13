<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignation extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'driver_id',
        'vehicle_id',
        'date_attribution',
        'cancel_date',
        'user_id',
        'created_by',
        'status'
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
    protected $with = ['vehicle'];

    protected $casts = [
        'date_attribution' => 'datetime',
        'cancel_date' => 'datetime'
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
