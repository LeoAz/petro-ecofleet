<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Supplying extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'code',
        'date',
        'start_point',
        'end_point',
        'description'

    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    protected $with = ['orders'];

    public function orders()
    {
        return $this->hasMany(FuelOrder::class, 'supply_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $code = now()->format('Ymd');
            $number= Supplying::orderBy('id','desc')->first();
            if( $number === null){
                $model->code = $code.'-'. 1;
            }else {
                $model->code =  $code.'-'.($number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
        });
    }
}
