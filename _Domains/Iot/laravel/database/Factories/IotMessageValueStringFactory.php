<?php

namespace Safitech\Iot\Database\Factories;

class IotMessageValueStringFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->word(),
        ];
    }
}
