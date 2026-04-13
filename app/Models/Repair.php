<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'description',
        'current_mileage',
        'amount',
        'status',
        'motif_id',
        'vehicle_id',
    ];

    protected $with = ['parts'];

    protected $appends = [ 'total_amount'];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function getTotalAmountAttribute()
    {
        $amount = [];
        foreach ( $this->parts as $part){
            $amount[] += $part->part->price *  $part->qty;
        }

        return $this->amount + (array_sum($amount));
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function motif()
    {
        return $this->belongsTo(Motif::class, 'motif_id');
    }

        public function parts()
    {
        return $this->hasMany(DetailRepair::class, 'repair_id');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model){
            $code = now()->format('Ym');
            $last_number= Repair::orderBy('id','desc')->first();
            if( $last_number === null){
                $model->code = $code.'-'. 1;
            }else {
                $model->code =  $code.'-'.($last_number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
        });
    }
}
