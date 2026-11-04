<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Raw Materials', 'description' => 'Cement, steel, sand, aggregate, and bricks.'],
            ['name' => 'Labor & Wages', 'description' => 'Daily wages for masons, helpers, and technicians.'],
            ['name' => 'Heavy Equipment', 'description' => 'Excavators, cranes, mixers, and fuel expenses.'],
            ['name' => 'Electrical & Lighting', 'description' => 'Wiring, breakers, fixtures, and conduits.'],
            ['name' => 'Plumbing & Drainage', 'description' => 'Pipes, sanitary fittings, and water tanks.'],
            ['name' => 'Finishing & Carpentry', 'description' => 'Tiles, paint, doors, and interior wood work.'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat['name']], $cat);
        }
    }
}
