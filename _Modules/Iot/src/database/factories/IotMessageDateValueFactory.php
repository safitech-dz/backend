<?php

namespace Safitech\Iot\Database\Factories;

class IotMessageDateValueFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->date(),
        ];
    }
}
