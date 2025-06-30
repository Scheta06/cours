<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Array = [
            [
                'title' => 'Игровой ПК',
                'description' => 'Игровой ПК для меня',
                'user_id' => 1,
                'processor_id' => 1,
                'motherboard_id' => 1,
                'cooler_id' => 1,
                'ram_id' => 1,
                'storage_id' => 1,
                'videocard_id' => 1,
                'psu_id' => 1,
                'chassis_id' => 1,
            ]
        ];

        foreach($Array as $item) {
            Configuration::create($item);
        }
    }
}
