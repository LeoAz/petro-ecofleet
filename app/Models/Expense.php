<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'trip_id',
        'type_id',
        'code_expense',
        'status',
        'date_expense',
        'box_id',
        'amount',
        'recap_id',
        'is_tier',
        'provider_id'
    ];

    protected $casts = [
        'date_expense' => 'datetime',
        'is_tier' => 'boolean',
        'status' => \App\Enums\Exploitation\ExpenseStatus::class
    ];

    protected $with = ['type', 'trip.vehicle'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function recap()
    {
        return $this->belongsTo(RecapDaily::class, 'recap_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function box()
    {
        return $this->belongsTo(Cashbox::class, 'box_id');
    }

    public function daily()
    {
        return $this->belongsTo(DailyExpense::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $code = now()->format('Ymd');
            $last_number= Expense::orderBy('id','desc')->first();
            if( $last_number === null){
                $model->code_expense = $code.'-'. 1;
            }else {
                $model->code_expense =  $code.'-'.($last_number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
        });

        self::created(function ($model){
            $daily = DailyExpense::where('date', $model->date_expense)
                ->where('type_id', $model->type_id)
                ->where('start_point', $model->trip->start_point)
                ->where('end_point', $model->trip->end_point)
                ->first();

            if ($daily === null){
                $new = DailyExpense::create([
                    'date' => $model->date_expense,
                    'start_point' => $model->trip->start_point,
                    'end_point' => $model->trip->end_point,
                    'type_id' => $model->type_id,
                    'description' => 'Recap des dépenses du' . ' ' . $model->date_expense->format('d/m/Y')
                ]);

                $model->daily_id = $new->id;

            } else {
                $model->daily_id = $daily->id;
            }
            $model->save();
        });

        self::created(function ($model){
            $daily = RecapDaily::where('date', $model->date_expense)
                ->first();

            if ($daily === null){
                $new = RecapDaily::create([
                    'date' => $model->date_expense,
                    'description' => 'Etat des dépenses du' . ' ' . $model->date_expense->format('d/m/Y')
                ]);

                $model->recap_id = $new->id;

            } else {
                $model->recap_id = $daily->id;
            }
            $model->save();
        });
    }
}
