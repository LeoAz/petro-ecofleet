<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_inventory',
        'description',
        'status'
    ];

    protected $casts = [
        'date_inventory' => 'datetime'
    ];

    public function details()
    {
        return $this->hasMany(DetailInventory::class, 'inventory_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $model->uuid = Str::uuid()->toString();
        });
    }
}
