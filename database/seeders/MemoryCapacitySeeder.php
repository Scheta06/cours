<?php

namespace Database\Seeders;

use App\Models\MemoryCapacity;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MemoryCapacitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Array = [
            2,
            4,
            6,
            8,
            10,
            12,
            16,
            20,
            24,
            32,
            64,
            128,
            256,
            512,
            1024,
            2048,
            4096,
        ];

        foreach($Array as $item) {
            MemoryCapacity::create([
                'title' => $item
            ]);
        }
    }
}
