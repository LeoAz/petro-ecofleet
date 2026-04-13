<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'op_type',
        'paid_at',
        'vehicle',
        'driver',
        'type_expense',
        'motif',
        'amount',
        'beneficiary',
        'description',
        'box_id',
    ];

    protected $casts = [
        'paid_at' => 'datetime'
    ];

    public function box()
    {
        return $this->belongsTo(Cashbox::class, 'box_id');
    }
}
