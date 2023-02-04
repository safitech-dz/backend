<?php

namespace Safitech\Iot\Packages\IotMessages;

use Safitech\Iot\Models\Base\BaseIotMessageValueModel;

class IotMessageValueDbMapper
{
    // public function getModelName(string $type): string
    // {
    // }

    public function getModelInstance(string $type): BaseIotMessageValueModel
    {
        // TODO: validate $type
        $type = ucfirst(strtolower($type));

        return  app()->make("Safitech\\Iot\\Models\\IotMessageValue{$type}");
    }

    public function getTableName(string $type): string
    {
        // TODO: validate $type
        $type = strtolower($type);

        return "iot_message_value_{$type}s";
    }
}
