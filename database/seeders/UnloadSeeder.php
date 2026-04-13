<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Trip;
use App\Models\Unload;
use Illuminate\Database\Seeder;

class UnloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unload::factory(50)->make()->each(function ($unload) {
            $product = Product::all();
            $trip = Trip::all();
            if ($product->count() > 0) $unload->product()->associate($product->random());
            if ($trip->count() > 0) $unload->trip()->associate($trip->random());
            $unload->save();
        });
    }
}
