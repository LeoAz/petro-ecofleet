<?php

namespace App\Models;

use App\Enums\Maintenance\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'provider_id',
        'vehicle_id',
        'description',
        'status'
    ];

    protected $with = ['enter.parts', 'provider'];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function purchase()
    {
        return $this->hasOne(Purchase::class, 'order_id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function parts()
    {
        return $this->hasMany(DetailOrder::class, 'order_id');
    }

    public function enter()
    {
        return $this->hasOne(EntranceVoucher::class, 'order_id');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $code = now()->format('Ym');
            $number = Order::orderBy('id', 'desc')->first();
            if ($number === null) {
                $model->code = 'BS' . '-' . $code . sprintf('%03d', 1);;
            } else {
                $model->code = 'BS' . '-' . $code . sprintf('%03d', $number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
            $model->status = OrderStatus::Created;
        });
    }
}
