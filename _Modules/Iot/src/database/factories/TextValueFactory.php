<?php

namespace Safitech\Iot\Database\Factories;

class TextValueFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->paragraph(),
        ];
    }
}
