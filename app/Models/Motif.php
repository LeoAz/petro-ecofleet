<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motif extends Model
{
    use HasFactory;

    protected $fillable = ['description'];

    public function repairs()
    {
        return $this->hasMany(Repair::class, 'motif_id');
    }

}
