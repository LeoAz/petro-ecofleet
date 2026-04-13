<?php

namespace Database\Seeders;

use App\Models\Brand;
use Faker\Provider\Uuid;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            'Mercedes',
            'Iveco',
            'Daf',
            'Sinotruck',
            'Renault',
        ];

        foreach ($brands as $brand){
            Brand::create([
                'uuid' => Uuid::uuid(),
                'name' => $brand
            ]);
        }
    }
}
