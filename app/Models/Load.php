<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Load extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'code',
        'num_bordereau',
        'date',
        'load_qty',
        'unit',
        'is_tier',
        'deposit_id',
        'product_id'
    ];

    protected $with = ['product', 'trip'];

    protected $casts = [
        'date' => 'datetime',
        'is_tier' => 'boolean'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
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
            $number= Load::orderBy('id','desc')->first();
            if( $number === null){
                $model->code = $code.'-'. 1;
            }else {
                $model->code =  $code.'-'.($number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
        });
    }
}
