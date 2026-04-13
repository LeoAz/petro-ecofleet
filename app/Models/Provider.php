<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'address'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'provider_id');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'provider_id');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model){
            $model->uuid = Str::uuid()->toString();
        });
    }
}
