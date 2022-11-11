<?php

namespace App\Http\Controllers;

use App\Packages\IotDataService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IotDataController extends Controller
{
    public function __invoke(Request $request)
    {
        $iot_data_service = new IotDataService($request);

        $def = $iot_data_service->getTopicDefinition();

        $data = Validator::make(
            [
                'message' => $request->message,
            ],
            [
                'message' => $def['format'],
            ]
        )->validate();

        $model_class = config('iot-data.models-map.'.$def['type']);

        /** @var Model */
        $iot_value = $model_class::create([
            'value' => $data['message'],
            'topic' => $iot_data_service->getCannonicalTopic(),
            'topic_user_id' => $iot_data_service->getTopicUserId(),
            'topic_client_id' => $iot_data_service->getTopicClientId(),
        ]);

        return $iot_value;
    }
}
