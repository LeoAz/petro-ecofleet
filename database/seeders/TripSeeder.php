<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Road;
use App\Models\Trip;
use App\Models\Vehicle;
use Database\Factories\TripFactory;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Trip::factory(300)->make()->each( function ($trip){
            $vehicle = Vehicle::all();
            $customer = Customer::all();
            $road = Road::all();
            $plan = Plan::all();
            $product = Product::all();

            $trip->vehicle()->associate($vehicle->random());
            $trip->customer()->associate($customer->random());
            if ($road->count() > 0) $trip->road()->associate($road->random());
            if ($plan->count() > 0) $trip->plan()->associate($plan->random());
            if ($product->count() > 0) $trip->product()->associate($product->random());

            $trip->save();

        });
    }
}
