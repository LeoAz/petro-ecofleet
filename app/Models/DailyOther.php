<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DailyOther extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'code',
        'date',
        'description'
    ];
    protected $with = ['others'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected $casts = [
        'date' => 'datetime'
    ];

    public function others()
    {
        return $this->hasMany(OtherExpense::class, 'daily_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $code = now()->format('Ymd');
            $number= DailyOther::orderBy('id','desc')->first();
            if( $number === null){
                $model->code = $code.'-'. 1;
            }else {
                $model->code =  $code.'-'.($number->id + 1);
            }
        });
    }
}
