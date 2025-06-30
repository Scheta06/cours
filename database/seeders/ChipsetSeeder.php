<?php
namespace Database\Seeders;

use App\Models\Chipset;
use Illuminate\Database\Seeder;

class ChipsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $AMD = 'AMD';
        $Intel = 'Intel';
        $Array = [
            [
                'title' => 'A520',
                'type' => $AMD,
                'socket_id' => 1,
            ],
            [
                'title' => 'B550',
                'type' => $AMD,
                'socket_id' => 1,
            ],
            [
                'title' => 'X570',
                'type' => $AMD,
                'socket_id' => 1,
            ],
            [
                'title' => 'A620',
                'type' => $AMD,
                'socket_id' => 2,
            ],
            [
                'title' => 'B650',
                'type' => $AMD,
                'socket_id' => 2,
            ],
            [
                'title' => 'H610',
                'type' => $Intel,
                'socket_id' => 4,
            ],
            [
                'title' => 'B760',
                'type' => $Intel,
                'socket_id' => 4,
            ],
            [
                'title' => 'Z790',
                'type' => $Intel,
                'socket_id' => 4,
            ],
        ];

        foreach ($Array as $item) {
            Chipset::create($item);
        }
    }
}
