<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Document::factory(50)->make()->each( function ($docs){
            $vehicle = Vehicle::all();
            $docs->vehicle()->associate($vehicle->random());

            $docs->save();

        });

        Document::factory(20)->make()->each( function ($docs){
            $driver = Driver::all();
            $docs->driver()->associate($driver->random());

            $docs->save();

        });
    }
}
