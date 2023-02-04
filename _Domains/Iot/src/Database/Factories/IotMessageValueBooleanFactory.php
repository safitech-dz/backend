<?php

namespace Safitech\Iot\Database\Factories;

class IotMessageValueBooleanFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->boolean(),
        ];
    }
}
