<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventories = [
            ['name' => 'Cement', 'description' => 'Portland cement for structural concrete work.'],
            ['name' => 'Steel Rebar', 'description' => 'Reinforcing steel bars for concrete structures.'],
            ['name' => 'Sand', 'description' => 'Fine aggregate for mortar and concrete mixes.'],
            ['name' => 'Gravel', 'description' => 'Coarse aggregate for concrete and drainage.'],
            ['name' => 'Bricks', 'description' => 'Clay bricks for masonry walls and partitions.'],
            ['name' => 'Tiles', 'description' => 'Ceramic and porcelain tiles for floors and walls.'],
            ['name' => 'Paint', 'description' => 'Interior and exterior architectural paints.'],
            ['name' => 'Electrical Wire', 'description' => 'Copper wiring for building electrical installations.'],
            ['name' => 'PVC Pipes', 'description' => 'Plastic pipes for plumbing and drainage systems.'],
            ['name' => 'Wood Planks', 'description' => 'Timber planks for formwork and carpentry.'],
        ];

        foreach ($inventories as $inventory) {
            Inventory::firstOrCreate(['name' => $inventory['name']], $inventory);
        }
    }
}
