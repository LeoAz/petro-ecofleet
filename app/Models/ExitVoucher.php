<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ExitVoucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'vehicle_id',
        'status_exit',
        'observation',
        'state_voucher',
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    protected $with = ['parts'];

    public function parts()
    {
        return $this->hasMany(DetailExitVoucher::class, 'exit_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $code = now()->format('Ym');
            $last_number= ExitVoucher::orderBy('id','desc')->first();
            if( $last_number === null){
                $model->code = $code . 'BS'. sprintf('%03d', 1);;
            }else {
                $model->code =  $code . 'BS'. sprintf('%03d', $last_number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
        });
    }
}
