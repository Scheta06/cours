<?php

namespace App\Services;

class PcCompatibilityChecker
{
    public function check(array $components): array
    {
        $errors = [];

        $this->checkSocketCompatibility($components, $errors);
        $this->checkCoolerCompatibility($components, $errors);
        $this->checkPsuCompatibility($components, $errors);
        $this->checkRamCompatibility($components, $errors);

        return $errors;
    }

    // Проверка совместимости сокета у процессора и материнской платы
    protected function checkSocketCompatibility(array $components, array &$errors): void
    {
        if (!isset($components['processor'], $components['motherboard'])) {
            return;
        }

        $processor = $components['processor'];
        $motherboard = $components['motherboard'];
        if ($processor &&
                $motherboard &&
                $processor->socket->id !== $motherboard->chipset->socket_id) {
            $errors['processor_and_motherboard'] = sprintf(
                'Процессор %s %s не совместим с материнской платой %s %s %s (разные сокеты)',
                $processor->vendor->title,
                $processor->title,
                $motherboard->vendor->title,
                $motherboard->chipset->title,
                $motherboard->title
            );
        }
    }

    // Проверка совместимости тепловыделения процессора с кулером
    protected function checkCoolerCompatibility(array $components, array &$errors): void
    {
        if (!isset($components['processor'], $components['cooler'])) {
            return;
        }

        $processor = $components['processor'];
        $cooler = $components['cooler'];

        if ($processor && $cooler && $processor->tdp > $cooler->power) {
            $errors['processor_and_cooler'] = sprintf(
                'Процессор %s %s не совместим с кулером %s %s (ТДП: %dW > %dW)',
                $processor->vendor->title,
                $processor->title,
                $cooler->vendor->title,
                $cooler->title,
                $processor->tdp,
                $cooler->power
            );
        }
    }

    // Проверка совместимости потребления процессора и видеокарты к блоку питания
    protected function checkPsuCompatibility(array $components, array &$errors): void
    {
        if (!isset($components['processor'], $components['videocard'], $components['psu'])) {
            return;
        }

        $compabilityPower = 1.3;
        $processor = $components['processor'];
        $videocard = $components['videocard'];
        $psu = $components['psu'];

        if (($processor && $videocard && $psu) && (($processor->tdp + $videocard->tdp) * $compabilityPower > $psu->power)) {
            $errors['processor_videocard_and_psu'] = sprintf(
                'Связка процессора %s %s и видеокарты %s %s не совместима с блоком питания %s %s (ТДП: %dW + %dW > %d)',
                $processor->vendor->title,
                $processor->title,
                $videocard->vendor->title,
                $videocard->title,
                $psu->vendor->title,
                $psu->title,
                $processor->tdp,
                $videocard->tdp,
                $psu->power,
            );
        }
    }

    // Проверка совместимости типа памяти для материнской платы и
    protected function checkRamCompatibility(array $components, array &$errors): void
    {
        if (!isset($components['ram'], $components['motherboard'])) {
            return;
        }

        $ram = $components['ram'];
        $motherboard = $components['motherboard'];

        if (($ram && $motherboard) && ($ram->memoryType->title !== $motherboard->memoryType->title)) {
            $errors['processor_and_ram'] = sprintf(
                'Оперативная память %s %s не совместима с материнской платой %s %s %s (разные типы памяти: %s и %s)',
                $ram->vendor->title,
                $ram->title,
                $motherboard->vendor->title,
                $motherboard->chipset->title,
                $motherboard->title,
                $motherboard->memoryType->title,
                $ram->memoryType->title,
            );
        }
    }
}
