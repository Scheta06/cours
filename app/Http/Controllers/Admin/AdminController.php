<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chassis;
use App\Models\Chipset;
use App\Models\Cooler;
use App\Models\Form;
use App\Models\MemoryCapacity;
use App\Models\MemoryType;
use App\Models\Motherboard;
use App\Models\Processor;
use App\Models\Psu;
use App\Models\Rams;
use App\Models\Socket;
use App\Models\Storage;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Videocard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ArrayOfModels = [
            Processor::class,
            Motherboard::class,
            Cooler::class,
            Storage::class,
            Rams::class,
            Videocard::class,
            Psu::class,
            Chassis::class,
        ];

        $productCount = 0;
        $userCount = User::all()->count();

        foreach ($ArrayOfModels as $item) {
            $productCount += $item::count();
        }

        return view('pages.admin.index', [
            'productCount' => $productCount,
            'userCount' => $userCount,
        ]);
    }

    public function category()
    {
        $categoryInfo = [
            'processors' => [
                'title' => 'Процессор',
                'subtitle' => 'Центральные процессоры (CPU)',
                'icon' => 'fas fa-microchip',
            ],
            'motherboards' => [
                'title' => 'Материнская плата',
                'subtitle' => 'Системные платы (MB)',
                'icon' => 'fas fa-project-diagram',
            ],
            'coolers' => [
                'title' => 'Охлаждение',
                'subtitle' => 'Кулеры и СЖО',
                'icon' => 'fas fa-fan',
            ],
            'rams' => [
                'title' => 'Оперативная память',
                'subtitle' => 'Модули RAM',
                'icon' => 'fas fa-memory',
            ],
            'storages' => [
                'title' => 'Накопитель',
                'subtitle' => 'SSD и HDD',
                'icon' => 'fas fa-hdd',
            ],
            'videocards' => [
                'title' => 'Видеокарта',
                'subtitle' => 'Графические процессоры (GPU)',
                'icon' => 'fas fa-gamepad',
            ],
            'psus' => [
                'title' => 'Блок питания',
                'subtitle' => 'Источники питания (PSU)',
                'icon' => 'fas fa-bolt',
            ],
            'chassis' => [
                'title' => 'Корпус',
                'subtitle' => 'Компьютерные корпуса',
                'icon' => 'fas fa-desktop',
            ],
        ];
        return view('pages.admin.create', [
            'categoryInfo' => $categoryInfo,
        ]);
    }

    public function items(Request $request)
    {
        $searchTerm = $request->input('search');
        $selectedCategory = $request->input('category');
        $category = Category::all();
        // Общая функция для фильтрации
        $filterItems = function ($query) use ($searchTerm, $selectedCategory) {
            if ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')->orWhere('title', 'like', '%' . $searchTerm . '%', 'in', 'vendors');
            }
            if ($selectedCategory) {
                $query->where('category_id', $selectedCategory);
            }
        };
        // dd($request->input('search'));

        $data = [
            'processors' => Processor::with(['category'])->where($filterItems)->get(),
            'motherboards' => Motherboard::with(['category', 'chipset'])->where($filterItems)->get(),
            'coolers' => Cooler::with(['category'])->where($filterItems)->get(),
            'storages' => Storage::with(['category'])->where($filterItems)->get(),
            'rams' => Rams::with(['category'])->where($filterItems)->get(),
            'videocards' => Videocard::with(['category'])->where($filterItems)->get(),
            'psus' => Psu::with(['category'])->where($filterItems)->get(),
            'chassis' => Chassis::with(['category'])->where($filterItems)->get(),
        ];

        return view('pages.admin.edit', [
            'data' => $data,
            'category' => $category,
            'searchTerm' => $searchTerm,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($componentTitle, Request $request)
    {
        $data = [];
        $vendor = Vendor::all();
        $socket = Socket::all();
        $form = Form::all();
        $chipset = Chipset::all();
        $memoryType = MemoryType::all();
        $memoryCapacity = MemoryCapacity::all();
        $processorVendor = $request->input('vendor_id');

        switch ($componentTitle) {
            case 'processors':
                array_push($data, [
                    'socket' => $socket,
                    'vendor' => $vendor->where('type', 'processor'),
                ]);
                break;
            case 'motherboards':
                array_push($data, [
                    'form' => $form->where('type', 'mb'),
                    'vendor' => $vendor->where('type', '!=', 'processor'),
                    'chipset' => $chipset,
                    'socket' => $socket,
                    'memoryType' => $memoryType,
                ]);
                break;
            case 'coolers':
                array_push($data, [
                    'vendor' => $vendor->where('type', '!=', 'processor'),
                ]);
                break;
            case 'rams':
                array_push($data, [
                    'vendor' => $vendor->where('type', '!=', 'processor'),
                    'memoryCapacity' => $memoryCapacity,
                    'memoryType' => $memoryType,
                ]);
                break;
            case 'storages':
                array_push($data, [
                    'vendor' => $vendor->where('type', '!=', 'processor'),
                    'memoryCapacity' => $memoryCapacity,
                ]);
                break;
            case 'videocards':
                array_push($data, [
                    'vendor' => $vendor->where('type', '!=', 'processor'),
                    'memoryCapacity' => $memoryCapacity,
                    'memoryType' => $memoryType,
                ]);
                break;
            case 'psus':
                array_push($data, [
                    'vendor' => $vendor->where('type', '!=', 'processor'),
                    'form' => $form->where('type', 'psu'),
                ]);
                break;
            case 'chassis':
                array_push($data, [
                    'vendor' => $vendor->where('type', '!=', 'processor'),
                    'form' => $form->where('type', 'case'),
                ]);
                break;
        }
        return view('pages.components.' . $componentTitle . '.create', [
            'data' => $data,
            'componentTitle' => $componentTitle,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $componentTitle)
    {
        switch ($componentTitle) {
            case 'processors':
                $data = $request->validate([
                    'title' => 'required|string|unique:processors,title',
                    'description' => 'string',
                    'count_of_cores' => 'integer|required',
                    'count_of_streams' => 'integer|required',
                    'base_frequency' => 'decimal:1,3|required',
                    'max_frequency' => 'decimal:1,3|required',
                    'tdp' => 'required',
                    'vendor_id' => 'required',
                    'socket_id' => 'required',
                    'category_id' => 'required',
                ], [
                    'title' => 'Поле `Название` обязательно к заполнению, должно быть уникальным и быть строкой',
                    'vendor_id' => 'Поле `Производитель` обязательно к заполнению',
                    'socket_id' => 'Поле `Сокет` обязательно к заполнению',
                    'description' => 'Поле `Описание` должно быть строкой',
                    'count_of_cores' => 'Поле `Количество ядер` обязательно к заполнению и должно быть целым числом',
                    'count_of_streams' => 'Поле `Количество потоков` обязательно к заполнению и должно быть целым числом',
                    'base_frequency' => 'Поле `Базовая частота` обязательно к заполнению и должно быть числом с плавающей точкой до 3 знаков после запятой',
                    'max_frequency' => 'Поле `Максимальная частота` обязательно к заполнению и должно быть числом с плавающей точкой до 3 знаков после запятой',
                    'tdp' => 'Поле `Тепловыделение` обязательно к заполнению и должно быть целым числом',
                ]);
                Processor::create($data);
                break;
            case 'motherboards':
                $data = $request->validate([
                    'title' => 'required|string',
                    'description' => 'string',
                    'vendor_id' => 'integer|required',
                    'form_id' => 'integer|required',
                    'memory_type_id' => 'integer|required',
                    'chipset_id' => 'integer|required',
                    'category_id' => 'integer|required',
                ], [
                    'title' => 'Поле `Название` обязательно к заполнению и должно быть строкой',
                    'description' => 'Поле `Описание` должно быть строкой',
                    'vendor_id' => 'Поле `Производитель` обязательно к заполнению',
                    'form_id' => 'Поле `Чипсет` обязательно к заполнению',
                    'memory_type_id' => 'Поле `Форм-фактор` обязательно к заполнению',
                    'chipset_id' => 'Поле `Тип памяти` обязательно к заполнению',
                ]);
                Motherboard::create($data);
                break;
            case 'coolers':
                $data = $request->validate([
                    'title' => 'required|string|unique:coolers,title',
                    'description' => 'string',
                    'power' => 'integer|required',
                    'vendor_id' => 'integer|required',
                    'category_id' => 'integer|required',
                ], [
                    'title' => 'Поле `Название` обязательно к заполнению, должно быть уникальным и быть строкой',
                    'description' => 'Поле `Описание` должно быть строкой',
                    'power' => 'Поле `Мощность` обязательно к заполнению и должно быть числом',
                    'vendor_id' => 'Поле `Производитель` обязательно к заполнению',
                ]);
                Cooler::create($data);
                break;
            case 'storages':
                $data = $request->validate([
                    'title' => 'required|string|unique:storages,title',
                    'description' => 'string',
                    'read_speed' => 'integer|required',
                    'record_speed' => 'integer|required',
                    'vendor_id' => 'integer|required',
                    'memory_capacity_id' => 'integer|required',
                    'category_id' => 'integer|required',
                ], [
                    'title' => 'Поле `Название` обязательно к заполнению, должно быть уникальным и быть строкой',
                    'description' => 'Поле `Описание` должно быть строкой',
                    'read_speed' => 'Поле `Скорость чтения` обязательно к заполнению и должно быть числом',
                    'record_speed' => 'Поле `Скорость записи` обязательно к заполнению и должно быть числом',
                    'vendor_id' => 'Поле `Производитель` обязательно к заполнению',
                    'memory_capacity_id' => 'Поле `Вместимость памяти` обязательно к заполнению и должно быть числом',
                ]);
                Storage::create($data);
                break;
            case 'rams':
                $data = $request->validate([
                    'title' => 'required|string|unique:rams,title',
                    'description' => 'string',
                    'count_of_modules' => 'integer|required',
                    'vendor_id' => 'integer|required',
                    'memory_capacity_id' => 'integer|required',
                    'memory_type_id' => 'integer|required',
                    'category_id' => 'integer|required',
                ], [
                    'title' => 'Поле `Название` обязательно к заполнению, должно быть уникальным и быть строкой',
                    'description' => 'Поле `Описание` должно быть строкой',
                    'count_of_modules' => 'Поле `Количество модулей` обязательно к заполнению и должно быть числом',
                    'vendor_id' => 'Поле `Производитель` обязательно к заполнению',
                    'memory_capacity_id' => 'Поле `Вместимость памяти` обязательно к заполнению и должно быть числом',
                    'memory_type_id' => 'Поле `Тип памяти` обязательно к заполнению и должно быть числом',
                ]);
                Rams::create($data);
                break;
            case 'videocards':
                $data = $request->validate([
                    'title' => 'required|string|unique:videocards,title',
                    'description' => 'string',
                    'max_frequency' => 'integer|required',
                    'tdp' => 'integer|required',
                    'vendor_id' => 'integer|required',
                    'memory_capacity_id' => 'integer|required',
                    'memory_type_id' => 'integer|required',
                    'category_id' => 'integer|required',
                ], [
                    'title' => 'Поле `Название` обязательно к заполнению, должно быть уникальным и быть строкой',
                    'description' => 'Поле `Описание` должно быть строкой',
                    'max_frequency' => 'Поле `Максимальная частота` обязательно к заполнению и должно быть числом',
                    'tdp' => 'Поле `Тепловыделение` обязательно к заполнению и должно быть числом',
                    'vendor_id' => 'Поле `Производитель` обязательно к заполнению',
                    'memory_capacity_id' => 'Поле `Вместимость памяти` обязательно к заполнению и должно быть числом',
                    'memory_type_id' => 'Поле `Тип памяти` обязательно к заполнению и должно быть числом',
                ]);
                Videocard::create($data);
                break;
            case 'psus':
                $data = $request->validate([
                    'title' => 'required|string|unique:psus,title',
                    'description' => 'string',
                    'power' => 'integer|required',
                    'vendor_id' => 'integer|required',
                    'form_id' => 'integer|required',
                    'category_id' => 'integer|required',
                ], [
                    'title' => 'Поле `Название` обязательно к заполнению, должно быть уникальным и быть строкой',
                    'description' => 'Поле `Описание` должно быть строкой',
                    'power' => 'Поле `Мощность` обязательно к заполнению и должно быть числом',
                    'vendor_id' => 'Поле `Производитель` обязательно к заполнению',
                    'form_id' => 'Поле `Форм-фактор` обязательно к заполнению',
                ]);
                Psu::create($data);
                break;
            case 'chassis':
                $data = $request->validate([
                    'title' => 'required|string|unique:psus,title',
                    'description' => 'string',
                    'vendor_id' => 'integer|required',
                    'form_id' => 'integer|required',
                    'category_id' => 'integer|required',
                ], [
                    'title' => 'Поле `Название` обязательно к заполнению, должно быть уникальным и быть строкой',
                    'description' => 'Поле `Описание` должно быть строкой',
                    'vendor_id' => 'Поле `Производитель` обязательно к заполнению',
                    'form_id' => 'Поле `Форм-фактор` обязательно к заполнению',
                ]);
                Chassis::create($data);
                break;
        }

        return redirect()->route('categoryOfCreateItemForm')->with('success', 'Товар создан');
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($componentTitle, $componentId)
    {
        $data = [];
        switch ($componentTitle) {
            case 'processors':
                $data = [
                    'componentInfo' => Processor::findOrFail($componentId),
                    'relations' => [
                        'vendor' => Vendor::where('type', 'processor')->get(),
                        'socket' => Socket::all(),
                    ],
                ];
                break;
            case 'motherboards':
                $data = [
                    'componentInfo' => Motherboard::findOrFail($componentId),
                    'relations' => [
                        'vendor' => Vendor::where('type', '!=', 'processor')->get(),
                        'socket' => Socket::all(),
                        'chipset' => Chipset::all(),
                        'memoryType' => MemoryType::all(),
                        'form' => Form::where('type', 'mb')->get(),
                    ],
                ];
                break;
            case 'coolers':
                $data = [
                    'componentInfo' => Cooler::findOrFail($componentId),
                    'relations' => [
                        'vendor' => Vendor::where('type', '!=', 'processor')->get(),
                    ],
                ];
                break;
            case 'storages':
                $data = [
                    'componentInfo' => Storage::findOrFail($componentId),
                    'relations' => [
                        'vendor' => Vendor::where('type', '!=', 'processor')->get(),
                        'memoryCapacity' => MemoryCapacity::all(),
                    ],
                ];
                break;
            case 'rams':
                $data = [
                    'componentInfo' => Rams::findOrFail($componentId),
                    'relations' => [
                        'vendor' => Vendor::where('type', '!=', 'processor')->get(),
                        'memoryCapacity' => MemoryCapacity::all(),
                        'memoryType' => MemoryType::all(),
                    ],
                ];
                break;
            case 'videocards':
                $data = [
                    'componentInfo' => Videocard::findOrFail($componentId),
                    'relations' => [
                        'vendor' => Vendor::all(),
                        'memoryCapacity' => MemoryCapacity::all(),
                        'memoryType' => MemoryType::all(),
                    ],
                ];
                break;
            case 'psus':
                $data = [
                    'componentInfo' => Psu::findOrFail($componentId),
                    'relations' => [
                        'vendor' => Vendor::where('type', '!=', 'processor')->get(),
                        'form' => Form::all(),
                    ],
                ];
                break;
            case 'chassis':
                $data = [
                    'componentInfo' => Chassis::findOrFail($componentId),
                    'relations' => [
                        'vendor' => Vendor::where('type', '!=', 'processor')->get(),
                        'form' => Form::all(),
                    ],
                ];
                break;
        }
        return view('pages.components.' . $componentTitle . '.edit', [
            'data' => $data,
            'componentTitle' => $componentTitle,
            'componentId' => $componentId,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $componentTitle, $componentId)
    {
        switch ($componentTitle) {
            case 'processors':
                $component = Processor::findOrFail($componentId);
                $validated = $request->all();
                $component->update($validated);
                break;
            case 'motherboards':
                $component = Motherboard::findOrFail($componentId);
                $validated = $request->all();
                $component->update($validated);
                break;
            case 'coolers':
                $component = Cooler::findOrFail($componentId);
                $validated = $request->all();
                $component->update($validated);
                break;
            case 'storages':
                $component = Storage::findOrFail($componentId);
                $validated = $request->all();
                $component->update($validated);
                break;
            case 'rams':
                $component = Rams::findOrFail($componentId);
                $validated = $request->all();
                $component->update($validated);
                break;
            case 'videocards':
                $component = Videocard::findOrFail($componentId);
                $validated = $request->all();
                $component->update($validated);
                break;
            case 'psus':
                $component = Psu::findOrFail($componentId);
                $validated = $request->all();
                $component->update($validated);
                break;
            case 'chassis':
                $component = Chassis::findOrFail($componentId);
                $validated = $request->all();
                $component->update($validated);
                break;
        }

        return redirect()->route('manageItemForm')->with('success', 'Данные товара обновлены!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($componentTitle, $componentId)
    {
        $data = null;
        switch ($componentTitle) {
            case 'processors':
                $data = Processor::findOrFail($componentId);
                $data->delete();
                break;
            case 'motherboards':
                $data = Motherboard::findOrFail($componentId);
                $data->delete();
                break;
            case 'coolers':
                $data = Cooler::findOrFail($componentId);
                $data->delete();
                break;
            case 'storages':
                $data = Storage::findOrFail($componentId);
                $data->delete();
                break;
            case 'rams':
                $data = Rams::findOrFail($componentId);
                $data->delete();
                break;
            case 'videocards':
                $data = Videocard::findOrFail($componentId);
                $data->delete();
                break;
            case 'psus':
                $data = Psu::findOrFail($componentId);
                $data->delete();
                break;
            case 'chassis':
                $data = Chassis::findOrFail($componentId);
                $data->delete();
                break;
        }

        return redirect()->route('manageItemForm')->with('success', 'Товар удален');
    }
}
