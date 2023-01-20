<?php

namespace App\Packages\IotData\Values;

use Illuminate\Database\Eloquent\Model;

class DataEntityMapper
{
    protected readonly array $models_map;

    protected readonly array $tables_map;

    public function __construct()
    {
        $this->models_map = [
            'boolean' => \App\Models\BooleanValue::class,
            'date' => \App\Models\DateValue::class,
            'float' => \App\Models\FloatValue::class,
            'integer' => \App\Models\IntegerValue::class,
            'string' => \App\Models\StringValue::class,
            'text' => \App\Models\TextValue::class,
            'time' => \App\Models\TimeValue::class,
            'json' => \App\Models\JsonValue::class,
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
