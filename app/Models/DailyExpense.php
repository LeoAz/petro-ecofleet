<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DailyExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'code',
        'date',
        'start_point',
        'end_point',
        'type_id',
        'description'
    ];
    protected $with = ['expenses'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected $casts = [
        'date' => 'datetime'
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'daily_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $code = now()->format('Ymd');
            $number= DailyExpense::orderBy('id','desc')->first();
            if( $number === null){
                $model->code = $code.'-'. 1;
            }else {
                $model->code =  $code.'-'.($number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
        });
    }
}
