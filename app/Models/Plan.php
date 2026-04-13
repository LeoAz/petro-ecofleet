<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'code_plan',
        'date_plan',
        'road_id',
        'status',
    ];

    protected $casts = [
        'date_plan' => 'datetime'
    ];

    public function vehicles()
    {
        return $this->hasMany(Trip::class);
    }

    public function road()
    {
        return $this->belongsTo(Road::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $code = now()->format('Ymd');
            $number= Plan::orderBy('id','desc')->first();
            if( $number === null){
                $model->code_plan = $code.'-'. 1;
            }else {
                $model->code_plan =  $code.'-'.($number->id + 1);
            }
        });
    }
}
