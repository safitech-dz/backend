<?php

namespace Safitech\Iot\Database\Factories;

class TimeValueFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->time(),
        ];
    }
}
