<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DetailInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'inventory_id',
        'real_qty',
        'theoriq_qty',
        'ecart',
        'observation'
    ];

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $model->uuid = Str::uuid()->toString();
            $model->ecart = $model->real_qty - $model->theoriq_qty;
        });
    }

}
