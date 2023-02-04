<?php

namespace Safitech\Iot\Domain\Packages\IotMessages;

use Illuminate\Support\Collection;

class IotMessageValueTypes
{
    public readonly Collection $value_types;

    public function __construct()
    {
        $this->value_types = collect([
            'boolean',
            'date',
            'float',
            'integer',
            'json',
            'string',
            'text',
            'time',
        ]);
    }

    // * add collection method when needed

    public function all(): array
    {
        return $this->value_types->all();
    }

    public function random(): string
    {
        return $this->value_types->random();
    }
}
