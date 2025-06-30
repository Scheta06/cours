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
        $Array = [
            [
                'title' => 'Процессор',
                'type' => 'processors',
            ],
            [
                'title' => 'Материнская плата',
                'type' => 'motherboards',
            ],
            [
                'title' => 'Кулер',
                'type' => 'coolers',
            ],
            [
                'title' => 'Накопитель',
                'type' => 'storages',
            ],
            [
                'title' => 'Оперативная память',
                'type' => 'rams',
            ],
            [
                'title' => 'Видеокарта',
                'type' => 'videocards',
            ],
            [
                'title' => 'Блок питания',
                'type' => 'psus',
            ],
            [
                'title' => 'Корпус',
                'type' => 'chassis',
            ],
        ];

        foreach ($Array as $item) {
            Category::create($item);
        }
    }
}
