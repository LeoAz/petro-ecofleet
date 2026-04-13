<?php

namespace App\Models;

use App\Enums\Maintenance\PurchaseStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'provider_id',
        'order_id',
        'status'
    ];

    protected $with = ['enter.parts', 'order'];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function parts()
    {
        return $this->hasMany(DetailPurchase::class, 'purchase_id');
    }

    public function enter()
    {
        return $this->hasOne(EntranceVoucher::class, 'purchase_id');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model){
            $code = now()->format('Ym');
            $last_number= Purchase::orderBy('id','desc')->first();
            if( $last_number === null){
                $model->code = $code.'-'. 1;
            }else {
                $model->code =  $code.'-'.($last_number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
            $model->status = PurchaseStatus::Pending;
        });
    }
}

