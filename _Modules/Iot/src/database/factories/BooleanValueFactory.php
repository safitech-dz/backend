<?php

namespace Safitech\Iot\Database\Factories;

class BooleanValueFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->boolean(),
        ];
    }
}
