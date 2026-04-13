<?php

namespace App\Models;

use App\Enums\Exploitation\PlanStatus;
use App\Enums\Exploitation\TripStatus;
use App\Enums\Fleet\VehicleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'date',
        'code_trip',
        'vehicle_id',
        'start_point',
        'end_point',
        'road_id',
        'customer_id',
        'plan_id',
        'is_tier',
        'quantity',
        'unit',
        'load_date',
        'delivery_date',
        'observation',
        'removal_order',
        'trailer',
        'driver',
        'status',
    ];

    protected $casts = [
        'delivery_date' => 'datetime',
        'load_date' => 'datetime',
        'date' => 'datetime',
        'return_date' => 'date',
        'quantity' => 'integer',
        'is_tier' => 'boolean',
    ];

    //protected $with = ['loads'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function fuelOrders()
    {
        return $this->hasMany(FuelOrder::class, 'trip_id');
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'trip_id');
    }

    public function loads()
    {
        return $this->hasOne(Load::class, 'trip_id');
    }

    public function sale()
    {
        return $this->hasOne(Detail::class, 'trip_id');
    }

    public function unloads()
    {
        return $this->hasOne(Unload::class, 'trip_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function road()
    {
        return $this->belongsTo(Road::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $code = now()->format('Ymd');
            $last_number= Trip::orderBy('id','desc')->first();
            if( $last_number === null){
                $model->code_trip = $code.'-'. 1;
            }else {
                $model->code_trip =  $code.'-'.($last_number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
            $model->trailer = $model->vehicle->activeTrailer ? $model->vehicle->activeTrailer->trailer->registration : '-';
            $model->driver = $model->vehicle->activeDriver ? $model->vehicle->activeDriver->driver->name : '-';
        });

        self::created(function ($model){
            $road = Road::where('start_point', $model->start_point)
                ->where('end_point', $model->end_point)
                ->first();

            if ($road === null){
                $trip = Road::create([
                    'start_point' => $model->start_point,
                    'end_point' => $model->end_point
                ]);

                $model->road_id = $trip->id;
                $model->save();

            } else {
                $model->road_id = $road->id;
                $model->save();
            }
        });

        self::created( function ($model){
            $vehicle = Vehicle::findorFail($model->vehicle_id);
            $vehicle->update([
                'status' => VehicleStatus::Travel
            ]);
        });

        self::created(function ($model){
            // creation du plan de chargement
            $plan = Plan::where('date_plan', $model->date->toDateString())
                ->where('road_id', $model->road_id)
                ->first();

            if( $plan === null )
            {
                $planning = Plan::create([
                    'uuid' => Str::uuid()->toString(),
                    'date_plan' => $model->date->toDateString(),
                    'road_id' => $model->road_id
                ]);

                $model->plan_id = $planning->id;
                $model->save();
            } else {
                $model->plan_id = $plan->id;
                $model->save();
            }
        });
    }
}
