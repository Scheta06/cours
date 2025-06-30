<?php
namespace Database\Seeders;

use App\Models\MemoryType;
use Illuminate\Database\Seeder;

class MemoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Array = [
            [
                'title' => 'DDR4',
            ],
            [
                'title' => 'DDR5',
            ],
            [
                'title' => 'GDDR6',
            ],
            [
                'title' => 'GDDR6X',
            ],
            [
                'title' => 'GDDR7',
            ],
            [
                'title' => 'GDDR7X',
            ],
        ];

        foreach ($Array as $item) {
            MemoryType::create($item);
        }
    }
}
