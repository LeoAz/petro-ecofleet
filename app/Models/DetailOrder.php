<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;


    protected $fillable = [
        'part_id',
        'qty',
        'unit_price'
    ];

    protected $with = ['part.category'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function part()
    {
        return $this->belongsTo(Part::class);
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
