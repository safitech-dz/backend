<?php

namespace Safitech\Iot\Database\Factories;

class IotMessageTextValueFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->paragraph(),
        ];
    }
}
