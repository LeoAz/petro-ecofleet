<?php

namespace Database\Seeders;

use App\Models\Garage;
use App\Models\Maintenance;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Maintenance::factory(15)->make()->each(function ($maintenance) {
            $garage = Garage::all();
            if ($garage->count() > 0) $maintenance->garage()->associate($garage->random());
            $maintenance->save();
        });
    }
}
