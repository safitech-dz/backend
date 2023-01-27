<?php

namespace Safitech\Iot\Packages\IotData\Values;

use Safitech\Iot\Models\BaseIotValueModel;

class DataEntityMapper
{
    public readonly array $value_types;

    public function __construct()
    {
        // TODO: use to check get calls
        $this->value_types = ['boolean', 'date', 'float', 'integer', 'json', 'string', 'text', 'time'];
    }

    // public function getModelName(string $type): string
    // {
    // }

    public function getModelInstance(string $type): BaseIotValueModel
    {
        $type = ucfirst(strtolower($type));

        return  app()->make("Safitech\\Iot\\Models\\IotMessage{$type}Value");
    }

    public function getTableName(string $type): string
    {
        $type = strtolower($type);

        return "iot_message_{$type}_values";
    }
}
