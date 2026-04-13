<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class States extends Model
{
    use HasFactory;

    protected $fillable = [
        'month',
        'year',
        'description',
        'status',
        'total_amount'
    ];

    protected $with = ['salaries.driver'];

    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class, 'state_id');
    }

}
