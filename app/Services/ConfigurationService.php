<?php

namespace App\Services;

use App\Models\{Processor, Motherboard, Cooler, Rams, Storage, Videocard, Psu, Chassis};

class ConfigurationService
{
    protected $configuration;
    protected $components;

    public function __construct()
    {
        $this->loadConfiguration();
    }

    public function loadConfiguration(): void
    {
        $this->configuration = session('configuration', [
            'processors' => null,
            'motherboards' => null,
            'coolers' => null,
            'rams' => null,
            'storages' => null,
            'videocards' => null,
            'psus' => null,
            'chassis' => null,
        ]);

        $this->loadComponents();
    }

    protected function loadComponents(): void
    {
        $this->components = [
            'processor' => $this->configuration['processors'] ? Processor::find($this->configuration['processors']) : null,
            'motherboard' => $this->configuration['motherboards'] ? Motherboard::find($this->configuration['motherboards']) : null,
            'cooler' => $this->configuration['coolers'] ? Cooler::find($this->configuration['coolers']) : null,
            'ram' => $this->configuration['rams'] ? Rams::find($this->configuration['rams']) : null,
            'storage' => $this->configuration['storages'] ? Storage::find($this->configuration['storages']) : null,
            'videocard' => $this->configuration['videocards'] ? Videocard::find($this->configuration['videocards']) : null,
            'psu' => $this->configuration['psus'] ? Psu::find($this->configuration['psus']) : null,
            'chassis' => $this->configuration['chassis'] ? Chassis::find($this->configuration['chassis']) : null,
        ];
    }

    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    public function getComponents(): array
    {
        return $this->components;
    }

    public function saveToSession(array $data): void
    {
        session(['configuration' => array_merge($this->configuration, $data)]);
        $this->loadConfiguration();
    }

    public function clearConfiguration(): void
    {
        session()->forget('configuration');
        $this->loadConfiguration();
    }
}
