<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Accident extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'place',
        'gravity',
        'amount',
        'description'
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $model->uuid = Str::uuid()->toString();
        });
    }
}
