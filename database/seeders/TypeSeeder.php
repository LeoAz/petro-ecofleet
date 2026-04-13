<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Frais de route',
            'frais de reparation de pneu',
            'frais de douane',
            'prime chauffeur',
            'ration alimentaire',
            'divers',
        ];

        foreach ($types as $type){
            Type::create([
                'description' => $type
            ]);
        }
    }
}
