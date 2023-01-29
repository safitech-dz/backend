<?php

namespace Safitech\Iot\Packages\IotMessages;

use Safitech\Iot\Models\BaseIotValueModel;

class IotMessageValueDbMapper
{
    // public function getModelName(string $type): string
    // {
    // }

    public function getModelInstance(string $type): BaseIotValueModel
    {
        // TODO: validate $type
        $type = ucfirst(strtolower($type));

        return  app()->make("Safitech\\Iot\\Models\\IotMessage{$type}Value");
    }

    public function getTableName(string $type): string
    {
        // TODO: validate $type
        $type = strtolower($type);

        return "iot_message_{$type}_values";
    }
}