<?php

namespace Safitech\Iot\Database\Factories;

class IotMessageValueTimeFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->time(),
        ];
    }
}
