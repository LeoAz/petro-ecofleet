<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OtherExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'daily_id',
        'uuid',
        'code',
        'date',
        'motif',
        'status',
        'beneficiary',
        'box_id',
        'amount',
        'recap_id'
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function recap()
    {
        return $this->belongsTo(RecapDaily::class, 'recap_id');
    }

    public function box()
    {
        return $this->belongsTo(Cashbox::class, 'box_id');
    }

    public function daily()
    {
        return $this->belongsTo(DailyOther::class, 'daily_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $code = now()->format('Ymd');
            $number= OtherExpense::orderBy('id', 'desc')->first();
            if( $number === null){
                $model->code = $code.'-'. 1;
            }else {
                $model->code =  $code.'-'.($number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
        });

        self::created(function ($model){
            $daily = DailyOther::where('date', $model->date)->first();

            if ($daily === null){
                $new = DailyOther::create([
                    'date' => $model->date,
                    'description' => 'Recap des autres dépenses du' . ' ' . $model->date->format('d/m/Y')
                ]);
                $model->daily_id = $new->id;
            } else {
                $model->daily_id = $daily->id;
            }
            $model->save();
        });

        self::created(function ($model){
            $daily = RecapDaily::where('date', $model->date)
                ->first();

            if ($daily === null){
                $new = RecapDaily::create([
                    'date' => $model->date,
                    'description' => 'Etat des dépenses du' . ' ' . $model->date->format('d/m/Y')
                ]);

                $model->recap_id = $new->id;

            } else {
                $model->recap_id = $daily->id;
            }
            $model->save();
        });
    }
}
