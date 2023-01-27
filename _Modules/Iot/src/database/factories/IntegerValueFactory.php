<?php

namespace Safitech\Iot\Database\Factories;

class IntegerValueFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => random_int(0, 2),
        ];
    }
}
