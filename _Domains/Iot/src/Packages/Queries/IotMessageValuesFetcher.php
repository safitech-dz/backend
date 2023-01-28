<?php

namespace Safitech\Iot\Packages\Queries;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Query\Builder;
use Safitech\Iot\Models\IotMessage;
use Safitech\Iot\Packages\IotData\Values\DataEntityMapper;
use Safitech\Iot\Packages\IotData\Values\IotMessageValueCaster;
use Safitech\Iot\Packages\Queries\Builders\UnionQueryIotMessageValues;

class IotMessageValuesFetcher
{
    protected array $messages_ids;

    protected array $value_types;

    protected EloquentCollection $collection;

    public function __construct(
        protected DataEntityMapper $data_entity_mapper,
        protected IotMessageValueCaster $caster,
        protected UnionQueryIotMessageValues $union_query_iot_message_values
    ) {
        $this->value_types = $data_entity_mapper->value_types;

        $this->collection = new EloquentCollection([]);
    }

    /**
     * 3 queries
     * - pluck messages IDs
     * - get unified values
     * - load messages for values
     */
    public function all()
    {
        $this->setMessagesIds();

        $results =
            $this->union_query_iot_message_values->getUnifiedQuery(
                $this->value_types,
                function (Builder $q) {
                    $q->whereIn('iot_message_id', $this->messages_ids)
                        ->orderBy('iot_message_id');
                }
            )
            ->get();

        foreach ($results as $result) {
            $model = $this->data_entity_mapper->getModelInstance($result->type)
                ->fill([
                    'iot_message_id' => $result->iot_message_id,
                    'value' => $this->caster->toType($result->value, $result->type),
                ]);

            $this->collection->push($model);
        }

        return $this->collection->load('iotMessage');
    }

    protected function filterMessages(EloquentBuilder $query): EloquentBuilder
    {
        return $query;
    }

    protected function setMessagesIds(): void
    {
        $this->messages_ids = $this->filterMessages(
            IotMessage::query()
        )->pluck('id')->toArray();
    }
}
