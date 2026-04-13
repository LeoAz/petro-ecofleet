<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Part;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Part::factory(50)->make()->each(function ($part) {
            $category = Category::all();
            if ($category->count() > 0) {
                $part->category()->associate($category->random());
            }
            $part->save();
        });
    }
}
