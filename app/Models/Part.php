<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'qty',
        'category_id',
        'buyer_id',
        'state',
        'reference',
    ];

    protected $with = ['category'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function repairs()
    {
        return $this->hasMany(DetailRepair::class, 'part_id');
    }

    public function maintenances()
    {
        return $this->hasMany(DetailMaintenance::class, 'part_id');
    }

    public function order()
    {
        return $this->hasMany(DetailOrder::class, 'part_id');
    }

    public function purchase()
    {
        return $this->hasMany(DetailPurchase::class, 'part_id');
    }

    public function entranceStock()
    {
        return $this->hasMany(DetailEntranceVoucher::class, 'part_id');
    }

    public function exitStock()
    {
        $this->hasMany(DetailExitVoucher::class, 'part_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $last_number= Part::orderBy('id','desc')->first();
            if( $last_number === null){
                $model->code = 'P'. sprintf('%06d', 1);;
            }else {
                $model->code =  'P'. sprintf('%06d', $last_number->id + 1);
            }
            $model->uuid = Str::uuid()->toString();
        });
    }

}
