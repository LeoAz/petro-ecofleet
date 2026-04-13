<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRepair extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'repair_id',
        'exit_voucher_id',
        'qty'
    ];

    protected $with = ['part.category'];

    public function repair()
    {
        return $this->belongsTo(Repair::class, 'repair_id');
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
