<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mb = 'mb';
        $psu = 'psu';
        $case = 'case';
        $Array = [
            [
                'title' => 'Standart ATX',
                'type' => $mb,
            ],
            [
                'title' => 'Micro-ATX',
                'type' => $mb,
            ],
            [
                'title' => 'Mini-ATX',
                'type' => $mb,
            ],
            [
                'title' => 'ATX',
                'type' => $psu,
            ],
            [
                'title' => 'SFX',
                'type' => $psu,
            ],
            [
                'title' => 'TFX',
                'type' => $psu,
            ],
            [
                'title' => 'Full-tower',
                'type' => $case,
            ],
            [
                'title' => 'Mid-tower',
                'type' => $case,
            ],
            [
                'title' => 'Mini-tower',
                'type' => $case,
            ],
        ];

        foreach($Array as $item) {
            Form::create($item);
        }
    }
}
