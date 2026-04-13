<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Pattern;
use App\Models\State;
use App\Models\Type;
use App\Models\Usage;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        vehicle::factory(150)->make()->each( function ($vehicle){
            $brand = Brand::all();
            $pattern = Pattern::all();

            $vehicle->brand()->associate($brand->random());
            $vehicle->pattern()->associate($pattern->random());

            $vehicle->save();

        });
    }
}
