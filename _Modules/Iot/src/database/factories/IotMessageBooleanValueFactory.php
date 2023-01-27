<?php

namespace Safitech\Iot\Database\Factories;

class IotMessageBooleanValueFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->boolean(),
        ];
    }
}
