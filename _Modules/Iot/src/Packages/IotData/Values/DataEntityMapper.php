<?php

namespace Safitech\Iot\Packages\IotData\Values;

use Illuminate\Database\Eloquent\Model;

class DataEntityMapper
{
    protected readonly array $models_map;

    protected readonly array $tables_map;

    public function __construct()
    {
        $this->models_map = [
            'boolean' => \Safitech\Iot\Models\BooleanValue::class,
            'date' => \Safitech\Iot\Models\DateValue::class,
            'float' => \Safitech\Iot\Models\FloatValue::class,
            'integer' => \Safitech\Iot\Models\IntegerValue::class,
            'string' => \Safitech\Iot\Models\StringValue::class,
            'text' => \Safitech\Iot\Models\TextValue::class,
            'time' => \Safitech\Iot\Models\TimeValue::class,
            'json' => \Safitech\Iot\Models\JsonValue::class,
        ];

        $this->tables_map = [
            'boolean' => 'boolean_values',
            'date' => 'date_values',
            'float' => 'float_values',
            'integer' => 'integer_values',
            'string' => 'string_values',
            'text' => 'text_values',
            'time' => 'time_values',
            'json' => 'json_values',
        ];
    }

    public function getModelName(string $type): string
    {
        return $this->models_map[$type];
    }

    public function getModelInstance(string $type): Model
    {
        return  app()->make($this->models_map[$type]);
    }

    public function getTableName(string $type): string
    {
        return $this->tables_map[$type];
    }
}
