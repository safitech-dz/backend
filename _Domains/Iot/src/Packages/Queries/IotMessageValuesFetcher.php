<?php

namespace Safitech\Iot\Packages\Queries;

use Safitech\Iot\Packages\IotData\Values\DataEntityMapper;
use Safitech\Iot\Packages\IotData\Values\IotMessageValueCaster;
use Safitech\Iot\Packages\Queries\Builders\UnionQueryIotMessageValues;

class IotMessageValuesFetcher
{
    protected array $value_types;

    public function __construct(
        protected DataEntityMapper $data_entity_mapper,
        protected IotMessageValueCaster $caster,
        protected UnionQueryIotMessageValues $union_query_iot_message_values
    ) {
        $this->value_types = $data_entity_mapper->value_types;
    }

    public function all()
    {
        $messages =
            $this->union_query_iot_message_values->getUnifiedQuery($this->value_types)
            ->join('iot_messages', 'id', '=', 'iot_message_id')
            // ->whereIn('iot_message_id', [1])
            ->orderBy('iot_message_id')
            ->get();

        foreach ($messages as $i => $message) {
            unset($message->iot_message_id);

            $message->value = $this->caster->toType($message->value, $message->type);

            unset($message->type);
        }

        return $messages;
    }
}
