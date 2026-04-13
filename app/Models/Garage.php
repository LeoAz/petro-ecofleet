<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'reason',
        'description',
        'status',
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    //protected $with = ['maintenances'];

    protected $appends = ['total_amount'];

    public function getTotalAmountAttribute()
    {
       $amount = [];

       if (! $this->maintenances == null)
       {
           foreach ( $this->maintenances?->parts as $part)
           {
               $amount[] += $part->part->price *  $part->qty;
           }
           return $this->maintenances?->amount + array_sum($amount);

       } else {
           return array_sum($amount);
       }
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function maintenances()
    {
        return $this->hasOne(Maintenance::class, 'garage_id');
    }
}
