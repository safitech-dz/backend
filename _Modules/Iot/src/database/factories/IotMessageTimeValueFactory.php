<?php

namespace Safitech\Iot\Database\Factories;

class IotMessageTimeValueFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->time(),
        ];
    }
}
