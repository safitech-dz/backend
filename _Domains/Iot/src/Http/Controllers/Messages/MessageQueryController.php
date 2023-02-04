<?php

namespace Safitech\Iot\Http\Controllers\Messages;

use Safitech\Iot\Models\IotMessage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder as SpatieQueryBuilder;

/**
 * @group Messages
 *
 * @subGroup Query
 */
class MessageQueryController
{
    /**
     * Query messages
     *
     * @response status=200 scenario=success
     * [
     *     {
     *         "value": true,
     *         "id": 1,
     *         "created_at": "2023-01-28 14:47:24",
     *         "updated_at": "2023-01-28 14:47:24",
     *         "canonical_topic": "%u/%d/actuator/irrignnov_V1/state",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator"
     *     },
     *     {
     *         "value": {
     *             "humidity": 55,
     *             "rainfall": 200,
     *             "pressure": 900,
     *             "temperature": 24,
     *             "wind_speed": 60
     *         },
     *         "id": 2,
     *         "created_at": "2023-01-28 14:47:27",
     *         "updated_at": "2023-01-28 14:47:27",
     *         "canonical_topic": "%u/%d/sensor/OWM/actualWeather",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator"
     *     },
     *     {
     *         "value": 797,
     *         "id": 3,
     *         "created_at": "2023-01-28 14:47:31",
     *         "updated_at": "2023-01-28 14:47:31",
     *         "canonical_topic": "%u/%d/actuator/irrignnov_V1/last_irrigation_end",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator"
     *     },
     *     {
     *         "value": 1.55,
     *         "id": 4,
     *         "created_at": "2023-01-28 14:47:40",
     *         "updated_at": "2023-01-28 14:47:40",
     *         "canonical_topic": "%u/%d/actuator/irrignnov_V1/kc",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator"
     *     }
     * ]
     */
    public function __invoke()
    {
        return SpatieQueryBuilder::for(IotMessage::class)
            ->with('IotMessageValue')
            ->allowedFilters([
                AllowedFilter::beginsWithStrict('canonical_topic'), // ! % in [%u,%d] isn't escaped
                'topic_client_id',
                'topic_user_id',
                AllowedFilter::exact('value', 'iot_message_values.value', false),
                'created_at',
                // TODO: add scopes
            ])
            ->defaultSort('id')
            ->allowedSorts('id')
            // TODO: handle InvalidFilterQuery+InvalidSortQuery exception
            ->get();
    }
}
