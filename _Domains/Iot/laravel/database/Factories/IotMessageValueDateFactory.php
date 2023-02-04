<?php

namespace Safitech\Iot\Database\Factories;

class IotMessageValueDateFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->date(),
        ];
    }
}
