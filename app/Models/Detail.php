<?php

namespace App\Models;

use App\Enums\Exploitation\TripState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'sale_id',
        'unit_price',
        'qty',
        'tax',
        'tax_amount',
        'total_price'
    ];

    protected $with = ['folder'];

    protected $casts = [
        'unit_price' => 'float'
    ];

    public function folder()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    protected static function boot()
    {
        parent::boot();
        self::created( function ($model){
            $folder = Trip::findorFail($model->trip_id);
            $sale = Sale::findOrFail($model->sale_id);
            //dd($sale);
            if($model->qty == $folder->unloads->unload_qty || $sale->details->sum('qty') == $folder->unloads->unload_qty){
                $folder->state = TripState::Billed;
                $folder->save();
            }
        });

        self::deleted( function ($model){
            $folder = Trip::findorFail($model->trip_id);
            $folder->state = TripState::Unbilled;
            $folder->save();
        });


    }
}
