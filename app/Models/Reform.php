<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reform extends Model
{
    use HasFactory;

    protected $fillable =  [
        'date',
        'reason'
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
