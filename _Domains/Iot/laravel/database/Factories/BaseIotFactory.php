<?php

namespace Safitech\Iot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

abstract class BaseIotFactory extends Factory
{
    public function modelName()
    {
        preg_match('/^.*\\\(?<model_name>[a-zA-Z]*)Factory$/', static::class, $model_name);

        return "Safitech\\Iot\\App\\Models\\{$model_name['model_name']}";
    }
}
