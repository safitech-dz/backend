<?php

namespace Safitech\Iot\Packages\IotData\Values;

use Illuminate\Support\Collection;

class IotValueTypes
{
    public readonly Collection $value_types;

    public function __construct()
    {
        $this->value_types = collect(['boolean', 'date', 'float', 'integer', 'json', 'string', 'text', 'time']);
    }

    public function all(): array
    {
        return $this->value_types->all();
    }

    public function random(): string
    {
        return $this->value_types->random();
    }
}
