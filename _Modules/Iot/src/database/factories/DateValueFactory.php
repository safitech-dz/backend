<?php

namespace Safitech\Iot\Database\Factories;

class DateValueFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'value' => $this->faker->date(),
        ];
    }
}
