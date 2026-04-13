<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'start_at',
        'end_at',
        'start_solde',
        'total_appros',
        'total_expenses',
        'solde',
        'status',
    ];

    public $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function operations()
    {
        return $this->hasMany(Operation::class, 'box_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'box_id');
    }

    public function others()
    {
        return $this->hasMany(OtherExpense::class, 'box_id');
    }

}
