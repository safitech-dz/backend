<?php

namespace Safitech\Iot\App\Http\Controllers\Messages;

use Safitech\Iot\App\Models\IotMessage;
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
     * @queryParam filters[value]
     *
     * @response status=200 scenario=success
     * [
     *     {
     *         "id": 1,
     *         "created_at": "2023-02-04T15:03:28.000000Z",
     *         "canonical_topic": "%u/%d/sensor/OWM/actualWeather",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator",
     *         "iot_message_value": {
     *             "iot_message_id": 1,
     *             "value": {
     *                 "humidity": 55,
     *                 "rainfall": 200,
     *                 "pressure": 900,
     *                 "temperature": 24,
     *                 "wind_speed": 60
     *             },
     *             "type": "json"
     *         }
     *     },
     *     {
     *         "id": 2,
     *         "created_at": "2023-02-04T15:03:29.000000Z",
     *         "canonical_topic": "%u/%d/actuator/irrignnov_V1/state",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator",
     *         "iot_message_value": {
     *             "iot_message_id": 2,
     *             "value": true,
     *             "type": "boolean"
     *         }
     *     },
     *     {
     *         "id": 3,
     *         "created_at": "2023-02-04T15:03:29.000000Z",
     *         "canonical_topic": "%u/%d/actuator/irrignnov_V1/last_irrigation_end",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator",
     *         "iot_message_value": {
     *             "iot_message_id": 3,
     *             "value": 876,
     *             "type": "integer"
     *         }
     *     },
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
                AllowedFilter::exact('value', 'iotMessageValue.value'),
                'created_at',
                // TODO: add scopes
            ])
            ->defaultSort('id')
            ->allowedSorts('id')
            // TODO: handle InvalidFilterQuery+InvalidSortQuery exception
            ->get();
    }
}
