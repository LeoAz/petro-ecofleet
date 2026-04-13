<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'amount',
        'qty'
    ];

    protected $with = ['part.category'];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model){
            $model->unit_price = $model->part->price ?? 0;
            $model->amount = $model->qty * $model->unit_price;
        });
    }
}
