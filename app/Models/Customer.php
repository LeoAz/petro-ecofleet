<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'address'
    ];


    protected $with = ['folders.unloads'];

    public function folders()
    {
        return $this->hasMany(Trip::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

}
