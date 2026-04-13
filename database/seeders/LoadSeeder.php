<?php

namespace Database\Seeders;

use App\Models\Load;
use App\Models\Product;
use App\Models\Trip;
use Illuminate\Database\Seeder;

class LoadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Load::factory(50)->make()->each(function ($load) {
            $product = Product::all();
            $trip = Trip::all();
            if ($product->count() > 0) $load->product()->associate($product->random());
            if ($trip->count() > 0) $load->trip()->associate($trip->random());
            $load->save();
        });
    }
}
