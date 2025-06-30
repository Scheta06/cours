<?php
namespace Database\Seeders;

use App\Models\Socket;
use Illuminate\Database\Seeder;

class SocketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Array = [
            [
                'title' => 'AM4',
            ],
            [
                'title' => 'AM5',
            ],
            [
                'title' => 'LGA 1200',
            ],
            [
                'title' => 'LGA 1700',
            ],
        ];

        foreach ($Array as $item) {
            Socket::create($item);
        }
    }
}
