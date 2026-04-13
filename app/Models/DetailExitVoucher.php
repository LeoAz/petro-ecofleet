<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailExitVoucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'reference',
        'qty'
    ];

    public function exit()
    {
        return $this->belongsTo(ExitVoucher::class, 'exit_id');
    }

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }
}
