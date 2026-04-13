<?php

namespace Database\Seeders;

use App\Models\FuelOrder;
use App\Models\Trip;
use Illuminate\Database\Seeder;

class FuelOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FuelOrder::factory(110)->make()->each( function ($fuel){
            $trip = Trip::all();
            $fuel->trip()->associate($trip->random());

            $fuel->save();

        });
    }
}
