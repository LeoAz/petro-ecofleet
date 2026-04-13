<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Unload extends Model
{
    use HasFactory;

    protected $fillable =[
        'uuid',
        'code',
        'date',
        'unload_qty',
        'is_tier',
        'missing',
        'place',
        'product_id',
    ];

    protected $with = ['trip.loads', 'product'];

    protected $casts = [
        'date' => 'datetime',
        'is_tier' => 'boolean'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $code = now()->format('Ymd');
            $number= Unload::orderBy('id','desc')->first();
            if( $number === null){
                $model->code = $code.'-'. 1;
            }else {
                $model->code =  $code.'-'.($number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
        });
    }
}
