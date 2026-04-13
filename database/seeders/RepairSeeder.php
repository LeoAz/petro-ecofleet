<?php

namespace Database\Seeders;

use App\Models\Motif;
use App\Models\Repair;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class RepairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Repair::factory(20)->make()->each(function ($repair) {
            $vehicle = Vehicle::all();
            $motif = Motif::all();
            if ($vehicle->count() > 0) $repair->vehicle()->associate($vehicle->random());
            if ($motif->count() > 0) $repair->motif()->associate($motif->random());
            $repair->save();
        });
    }
}
