<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Pattern;
use App\Models\State;
use App\Models\Trailer;
use App\Models\Type;
use App\Models\Usage;
use App\Models\vehicle;
use Illuminate\Database\Seeder;

class TrailerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Trailer::factory(170)->make()->each(function($trailer){
            $brand = Brand::all();
            $pattern = Pattern::all();

            $trailer->brand()->associate($brand->random());
            $trailer->pattern()->associate($pattern->random());

            $trailer->save();
        });
    }
}
