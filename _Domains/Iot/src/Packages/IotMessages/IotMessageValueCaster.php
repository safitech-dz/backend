<?php

namespace Safitech\Iot\Domain\Packages\IotMessages;

class IotMessageValueCaster
{
    public function toDb(mixed $value, string $type): mixed
    {
        return match ($type) {
            'json' => json_encode($value),
            default => $value,
        };
    }

    public function toType(mixed $value, string $type): mixed
    {
        return match ($type) {
            'json' => json_decode($value, true),
            'integer' => (int) $value,
            'boolean' => (bool) $value,
            'float' => (float) $value,
            default => $value,
        };
    }
}
