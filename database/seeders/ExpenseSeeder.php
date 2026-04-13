<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\Trip;
use App\Models\Type;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expense::factory(100)->make()->each( function ($exp){
            $trip = Trip::all();
            $type = Type::all();

            $exp->trip()->associate($trip->random());
            $exp->type()->associate($type->random());

            $exp->save();

        });
    }
}
