<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'mileage',
        'description',
        'treshold',
        'unit',
        'amount',
        'next_mileage',
        'next_date'
    ];

    protected $appends = ['total_amount'];

    protected $casts = [
        'date' => 'datetime',
        'next_date' => 'datetime'
    ];

    protected $with = ['garage', 'parts'];

    public function garage()
    {
        return $this->belongsTo(Garage::class, 'garage_id');
    }

    public function parts()
    {
        return $this->hasMany(DetailMaintenance::class, 'maintenance_id');
    }

    public function getTotalAmountAttribute()
    {
        $amount = [];

        if (! $this->parts == null)
        {
            foreach ( $this->parts as $part)
            {
                $amount[] += $part->part->price *  $part->qty;
            }
            return $this->amount + array_sum($amount);

        } else {
            return array_sum($amount);
        }
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $code = now()->format('Ym');
            $last_number= Maintenance::orderBy('id','desc')->first();
            if( $last_number === null){
                $model->code = $code . 'M'. sprintf('%06d', 1);;
            }else {
                $model->code =  $code . 'M'. sprintf('%06d', $last_number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
        });
    }
}
