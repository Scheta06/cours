<?php

namespace App\Http\Controllers;

use App\Models\Chassis;
use App\Models\Configuration;
use App\Models\Cooler;
use App\Models\Motherboard;
use App\Models\Processor;
use App\Models\Psu;
use App\Models\Rams;
use App\Models\Storage;
use App\Models\Videocard;
use App\Services\ConfigurationService;
use App\Services\PcCompatibilityChecker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{
    protected $configService;

    public function __construct(ConfigurationService $configService)
    {
        $configService = $this->configService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PcCompatibilityChecker $checker, ConfigurationService $configService, Request $request)
    {
        $components = $configService->getComponents();

        $configurationErrors = $checker->check($components);

        $componentList = config('constans.componentList');

        foreach ($componentList as $key => &$item) {
            if ($key !== 'chassis') {
                $componentKey = preg_replace('/s$/', '', $key);
            } else {
                $componentKey = $key;
            }

            $item['selectedComponent'] = $components[$componentKey] ?? null;
        }

        return view('index', [
            'componentList' => $componentList,
            'configuration' => $configService->loadConfiguration(),
            'configurationErrors' => $configurationErrors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $componentTitle, $componentId, ConfigurationService $configService)
    {
        $data = [
            $componentTitle => $componentId
        ];

        $configService->saveToSession($data);

        return redirect()->route('index')->with('success', 'Компонент успешно добавлен');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConfigurationService $configService)
    {
        $build = session('configuration', []);
        $requiredComponents = [
            'processors' => 'Процессор',
            'motherboards' => 'Материнская плата',
            'coolers' => 'Кулер',
            'rams' => 'Оперативная память',
            'storages' => 'Накопитель',
            'videocards' => 'Видеокарта',
            'psus' => 'Блок питания',
            'chassis' => 'Корпус',
        ];

        $missing = [];
        foreach ($requiredComponents as $key => $name) {
            if (empty($build[$key])) {
                $missing[] = $name;
            }
        }
        if (!empty($missing)) {
            return redirect()->back()->withErrors($missing)->withInput();
        }

        // Создаём конфигурацию
        Configuration::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => Auth::id(),
            'processor_id' => $build['processors'],
            'motherboard_id' => $build['motherboards'],
            'cooler_id' => $build['coolers'],
            'ram_id' => $build['rams'],
            'storage_id' => $build['storages'],
            'videocard_id' => $build['videocards'],
            'psu_id' => $build['psus'],
            'chassis_id' => $build['chassis'],
        ]);

        $configService->clearConfiguration();

        return redirect()->route('index')->with('success', 'Конфигурация сохранена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($configurationId)
    {
        $configuration = Configuration::findOrFail($configurationId);

        $configuration->delete();

        return redirect()->back()->with('success', 'Конфигурация удалена!');
    }
}
