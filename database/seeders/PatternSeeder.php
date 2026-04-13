<?php

namespace Database\Seeders;

use App\Models\Pattern;
use Faker\Provider\Uuid;
use Illuminate\Database\Seeder;

class PatternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patterns = [
            'Howo 566',
            'Actros 250',
            'kerax',
            'Model test1',
            'model test2'
        ];

        foreach ($patterns as $pattern){
            Pattern::create([
                'uuid' => Uuid::uuid(),
                'name' => $pattern
            ]);
        }
    }
}
