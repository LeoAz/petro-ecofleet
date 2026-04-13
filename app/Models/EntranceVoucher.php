<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EntranceVoucher extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'purchase_id'];

    protected $with = ['parts'];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function parts()
    {
        return $this->hasMany(DetailEntranceVoucher::class, 'entrance_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $code = now()->format('Ym');
            $last_number= EntranceVoucher::orderBy('id','desc')->first();
            if( $last_number === null){
                $model->code = 'BE'. '-' .$code. sprintf('%03d', 1);;
            }else {
                $model->code =  'BE'. '-' .$code . sprintf('%03d', $last_number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
        });
    }
}
