<?php

return [
    'models-map' => [
        'boolean' => App\Models\BooleanValue::class,
        'date' => App\Models\DateValue::class,
        'float' => App\Models\FloatValue::class,
        'integer' => App\Models\IntegerValue::class,
        'string' => App\Models\StringValue::class,
        'text' => App\Models\TextValue::class,
        'time' => App\Models\TimeValue::class,
    ],

    'tables-map' => [
        'boolean' => 'boolean_values',
        'date' => 'date_values',
        'float' => 'float_values',
        'integer' => 'integer_values',
        'string' => 'string_values',
        'text' => 'text_values',
        'time' => 'time_values',

    ],
];
