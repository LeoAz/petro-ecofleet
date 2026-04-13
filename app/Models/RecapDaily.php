<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecapDaily extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'description'
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'recap_id');
    }

    public function others(): HasMany
    {
        return $this->hasMany(OtherExpense::class, 'recap_id');
    }

}
