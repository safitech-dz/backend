<?php

namespace Safitech\Iot\Database\Factories;

class FloatValueFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->randomFloat(1, 0, 2),
        ];
    }
}
