<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'customer_id',
        'code_sale',
        'date_sale',
        'qty_remaining'
    ];

    protected $with = ['details'];
    protected $appends = [ 'total_amount'];

    protected $casts = [
        'date_sale' => 'datetime'
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function getTotalAmountAttribute()
    {
        $amount = [];
        foreach ( $this->details as $detail){
            $amount[] += $detail->total_price;
        }

        return array_sum($amount);
    }

    public function details()
    {
        return $this->hasMany(Detail::class, 'sale_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model){
            $code = now()->format('Ymd');
            $last_number= Sale::orderBy('id','desc')->first();
            if( $last_number === null){
                $model->code_sale = $code.'-'. 1;
            }else {
                $model->code_sale =  $code.'-'.($last_number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
        });
    }
}
