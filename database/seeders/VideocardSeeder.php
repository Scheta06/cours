<?php
namespace Database\Seeders;

use App\Models\Videocard;
use Illuminate\Database\Seeder;

class VideocardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Array = [
            [
                'title' => 'RX 6600 Pulse',
                'description' => 'Видеокарта Sapphire AMD Radeon RX 6600 PULSE из игровой линейки обеспечивает эффектный внешний вид и высокую вычислительную мощность графики, при этом обладает компактными размерами. Процессор на архитектуре AMD RDNA 2 обладает номинальной частотой 1628 МГц. Видеопамять объемом 8 ГБ отличается пропускной способностью 14000 МГц.
                В Sapphire AMD Radeon RX 6600 PULSE применяется кулер воздушного охлаждения с двумя вентиляторами, который предотвращает перегрев при длительных сеансах игры. Передняя сторона украшена полосами красного цвета. Из интерфейсов подключения предлагаются 3 разъема DisplayPort и разъем HDMI. Надежные компоненты гарантируют стабильность работы видеокарты.',
                'max_frequency' => 2491,
                'vendor_id' => 1,
                'tdp' => 100,
                'memory_capacity_id' => 4,
                'memory_type_id' => 3,
                'category_id' => 6,
            ],
            [
                'title' => 'GeForce RTX 5090 TUF Gaming OC Edition',
                'description' => 'Видеокарта ASUS GeForce RTX 5090 TUF Gaming OC Edition выделяется качественной элементной базой повышенной надежности и мощными техническими характеристиками. ASUS GeForce RTX 5090 TUF Gaming OC Edition оборудована кулером воздушного охлаждения с тремя вентиляторами. Они создают интенсивный поток воздуха и быстро рассеивают тепло от внутренних компонентов. Вывод изображения на мониторы выполняется посредством HDMI и DisplayPort разъемов.',
                'max_frequency' => 2580,
                'vendor_id' => 5,
                'tdp' => 700,
                'memory_capacity_id' => 10,
                'memory_type_id' => 5,
                'category_id' => 6,
            ],
            [
                'title' => 'GeForce RTX 4060 Infinity 2',
                'description' => 'Видеокарта Palit GeForce RTX 4060 Infinity 2 [NE64060019P1-1070L] ориентирована на сборку и модернизацию игровых системных блоков среднего уровня. Устройство охлаждается парой 95-миллиметровых вентиляторов, которые при невысокой нагрузке останавливаются. Длина видеоадаптера составляет 250 мм. Показатель гарантирует модели широкую совместимость с корпусами разных форм-факторов. Видеокарта оснащена 4 видеоразъемами – HDMI и 3 DisplayPort. Допускается одновременное подключение до 4 мониторов. Поддерживается разрешение до 7680x4320 (8K Ultra HD).
                Основной элемент конструкции видеокарты Palit GeForce RTX 4060 Infinity 2 [NE64060019P1-1070L] – графический процессор GeForce RTX 4060 на основе микроархитектуры NVIDIA Ada Lovelace. Потенциал видеочипа реализует 8-гигабайтная память GDDR6 с пропускной способностью 272 ГБ/с и эффективной частотой 17000 МГц. 24-мегабайтный кэш L2 увеличивает скорость обмена данными между VRAM и GPU. В модели реализованы 96 тензорных ядер и 24 RT-ядра. Первые увеличивают быстродействие рендеринга, а вторые производят аппаратное ускорение трассировки лучей.',
                'max_frequency' => 2460,
                'vendor_id' => 15,
                'tdp' => 115,
                'memory_capacity_id' => 4,
                'memory_type_id' => 3,
                'category_id' => 6,
            ],
            [
                'title' => 'GeForce RTX 3050 VENTUS 2X XS OC',
                'description' => 'Видеокарта MSI GeForce RTX 3050 VENTUS 2X XS OC [RTX 3050 VENTUS 2X XS 8G OC] подходит для рабочей станции и игрового компьютера. Благодаря платформе с архитектурой NVIDIA Ampere и 8 ГБ памяти GDDR6 она обеспечивает высокую производительность графики. Тензорные ядра, потоковые мультипроцессоры и технология трассировки лучей гарантируют реалистичность передачи деталей изображения.
                Видеокарта MSI GeForce RTX 3050 VENTUS 2X XS OC охлаждается алюминиевым радиатором и 2 вентиляторами, которые стабильно рассеивают тепло при разной вычислительной нагрузке. Металлическая пластина на тыловой стороне улучшает охлаждение и усиливает прочность конструкции. Для подключения к источникам вывода изображения есть по 1 разъему DVI-D, DisplayPort и HDMI. Управлять параметрами графической мощности и осуществлять мониторинг состояния позволяет утилита MSI Afterburner.',
                'max_frequency' => 1807,
                'vendor_id' => 3,
                'tdp' => 115,
                'memory_capacity_id' => 4,
                'memory_type_id' => 3,
                'category_id' => 6,
            ],
        ];

        foreach ($Array as $item) {
            Videocard::create($item);
        }
    }
}
