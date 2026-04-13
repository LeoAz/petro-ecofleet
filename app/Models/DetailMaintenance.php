<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMaintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'maintenance_id',
        'exit_voucher_id',
        'qty'
    ];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class, 'maintenance_id');
    }

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }

    public function exit()
    {
        return $this->belongsTo(ExitVoucher::class, 'exit_voucher_id');
    }
}
