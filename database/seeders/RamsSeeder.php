<?php
namespace Database\Seeders;

use App\Models\Rams;
use Illuminate\Database\Seeder;

class RamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Array = [
            [
                'title' => 'XPG Gammix D35',
                'description' => 'Оперативная память ADATA XPG GAMMIX D35 [AX4U320016G16A-DTBKD35] представлена комплектом в виде двух модулей стандарта DDR4 объемом по 16 ГБ. Они помогают увеличить скорость операционной системы, уменьшить время обработки ресурсов в программах и играх. Тактовая частота 3200 МГц и пропускная способность в пределах 25600 Мбайт/сек обеспечивают быстродействие. На планках расположены алюминиевые радиаторы, которые стабильно отводят тепло от чипов в процессе вычислительной нагрузки. Небольшая высота 34 мм гарантирует широкую совместимость с комплектующими и удобство установки модулей ADATA XPG GAMMIX D35 [AX4U320016G16A-DTBKD35].',
                'count_of_modules' => 2,
                'vendor_id' => 7,
                'memory_capacity_id' => 4,
                'memory_type_id' => 1,
                'category_id' => 5,
            ],
        ];

        foreach ($Array as $item) {
            Rams::create($item);
        }
    }
}
