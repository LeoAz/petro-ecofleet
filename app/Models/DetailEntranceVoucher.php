<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEntranceVoucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'qty'
    ];

    public function entrance()
    {
        return $this->belongsTo(EntranceVoucher::class, 'entrance_id');
    }

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }
}
