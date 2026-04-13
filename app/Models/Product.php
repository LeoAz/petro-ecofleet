<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    //protected $with = ['folder.loads'];

    public function loads()
    {
        return $this->hasMany(Load::class);
    }

    public function unloads()
    {
        return $this->hasMany(Unload::class);
    }

    public function folder()
    {
        return $this->hasMany(Trip::class);
    }
}
