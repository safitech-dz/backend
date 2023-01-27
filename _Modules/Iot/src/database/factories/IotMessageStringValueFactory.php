<?php

namespace Safitech\Iot\Database\Factories;

class IotMessageStringValueFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->word(),
        ];
    }
}
