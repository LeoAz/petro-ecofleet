<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\Trip;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sale::factory(90)->make()->each( function ($sale){
            $trip = Trip::all();

            $sale->trip()->associate($trip->random());

            $sale->save();

        });
    }
}
