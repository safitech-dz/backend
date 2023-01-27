<?php

namespace Safitech\Iot\Database\Factories;

class IotMessageIntegerValueFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => random_int(0, 2),
        ];
    }
}
