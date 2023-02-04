<?php

namespace Safitech\Iot\Database\Factories;

class IotMessageValueTextFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->paragraph(),
        ];
    }
}
