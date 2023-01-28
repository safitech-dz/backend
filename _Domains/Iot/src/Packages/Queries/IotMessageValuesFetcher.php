<?php

namespace Safitech\Iot\Packages\Queries;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Safitech\Iot\Models\IotMessage;
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
        $query = $this->baseQuery();

        $query = $this->filter($query);

        $query = $this->orderBy($query, 'iot_message_id');

        $messages = $query->get();

        foreach ($messages as $message) {
            unset($message->iot_message_id);

            $message->value = $this->caster->toType($message->value, $message->type);

            unset($message->type);
        }

        return $messages;
    }

    protected function baseQuery(): EloquentBuilder
    {
        return
            IotMessage::query()
            ->select(['iot_message_values.*', 'iot_messages.*'])
            ->fromSub($this->union_query_iot_message_values->getUnifiedQuery($this->value_types), 'iot_message_values')
            ->join('iot_messages', 'iot_messages.id', '=', 'iot_message_values.iot_message_id');
    }

    protected function filter(EloquentBuilder $query, array $filters = []): EloquentBuilder
    {
        if (empty($filters)) {
            return $query;
        }

        return $query
            // ->whereIn('iot_message_id', [1])
;
    }

    protected function orderBy(EloquentBuilder $query, ?string $column = null): EloquentBuilder
    {
        if (is_null($column)) {
            return $query;
        }

        return $query->orderBy($column);
    }
}
