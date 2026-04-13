<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'trip_id',
        'provider_id',
        'place',
        'code_order',
        'date_order',
        'quantity',
        'unit_price',
        'total_price',
        'supply_id',
        'is_tier',
    ];

    protected $casts = [
        'date_order' => 'datetime',
        'is_tier' => 'boolean'
    ];

    protected $with = ['trip'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $code = now()->format('Ymd');
            $last_number= FuelOrder::orderBy('id','desc')->first();
            if( $last_number === null){
                $model->code_order = $code.'-'. 1;
            }else {
                $model->code_order =  $code.'-'.($last_number->id + 1);
            }

            $model->total_price = $model->quantity * $model->unit_price;
        });

        self::created(function ($model){
            $daily = Supplying::where('date', $model->date_order)
                ->where('start_point', $model->trip->start_point)
                ->where('end_point', $model->trip->end_point)
                ->first();

            if ($daily === null)
            {
                $new = Supplying::create([
                    'date' => $model->date_order,
                    'start_point' => $model->trip->start_point,
                    'end_point' => $model->trip->end_point,
                    'description' => 'Recap des bons de carburant du' . ' ' . $model->date_order->format('d/m/Y')
                ]);

                $model->supply_id = $new->id;
                $model->save();

            } else {
                $model->supply_id = $daily->id;
                $model->save();
            }
        });

        self::updating( function ($model){
            $model->total_price = $model->quantity * $model->unit_price;
        });
    }
}
