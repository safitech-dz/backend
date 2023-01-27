<?php

namespace Safitech\Iot\Database\Factories;

class StringValueFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->word(),
        ];
    }
}
