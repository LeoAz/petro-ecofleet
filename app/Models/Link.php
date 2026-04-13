<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'vehicle_id',
        'trailer_id',
        'link_date',
        'unlink_date',
        'status',
    ];

    protected $with = [
        'trailer',
        'vehicle'
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * @var string[]
     */
    protected $casts = [
        'link_date' => 'datetime',
        'unlink_date' => 'datetime'
    ];

    /**
     * @return BelongsTo
     */
    public function trailer(): BelongsTo
    {
        return $this->belongsTo(Trailer::class);
    }

    /**
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
