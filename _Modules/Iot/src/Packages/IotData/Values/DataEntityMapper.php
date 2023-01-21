<?php

namespace Safitech\Iot\Packages\IotData\Values;

use Illuminate\Database\Eloquent\Model;
use Safitech\Iot\Models\BooleanValue;
use Safitech\Iot\Models\DateValue;
use Safitech\Iot\Models\FloatValue;
use Safitech\Iot\Models\IntegerValue;
use Safitech\Iot\Models\JsonValue;
use Safitech\Iot\Models\StringValue;
use Safitech\Iot\Models\TextValue;
use Safitech\Iot\Models\TimeValue;

class DataEntityMapper
{
    public readonly array $value_types;

    protected readonly array $models_map;

    protected readonly array $tables_map;

    public function __construct()
    {
        // TODO: use to check get calls
        $this->value_types = ['boolean', 'date', 'float', 'integer', 'json', 'string', 'text', 'time'];

        $this->models_map = [
            'boolean' => BooleanValue::class,
            'date' => DateValue::class,
            'float' => FloatValue::class,
            'integer' => IntegerValue::class,
            'json' => JsonValue::class,
            'string' => StringValue::class,
            'text' => TextValue::class,
            'time' => TimeValue::class,
        ];

        $this->tables_map = [
            'boolean' => 'boolean_values',
            'date' => 'date_values',
            'float' => 'float_values',
            'integer' => 'integer_values',
            'json' => 'json_values',
            'string' => 'string_values',
            'text' => 'text_values',
            'time' => 'time_values',
        ];
    }

    // public function getModelName(string $type): string
    // {
    //     return $this->models_map[$type];
    // }

    public function getModelInstance(string $type): Model
    {
        return  app()->make($this->models_map[$type]);
    }

    public function getTableName(string $type): string
    {
        return $this->tables_map[$type];
    }
}
