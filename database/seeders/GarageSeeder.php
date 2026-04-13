<?php

namespace Database\Seeders;

use App\Models\Garage;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class GarageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Garage::factory(10)->make()->each(function ($garage) {
            $vehicle = Vehicle::all();
            if ($vehicle->count() > 0) $garage->vehicle()->associate($vehicle->random());
            $garage->save();
        });
    }
}
