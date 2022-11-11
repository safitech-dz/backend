<?php

namespace App\Http\Controllers;

use App\Models\IotData;
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
                'message' => $request->message
            ],
            [
                'message' => $def['format'],
            ]
        )->validate();

        $model_class = config("iot-models-map." . $def['type']);

        $iot_data = IotData::create([
            'type_of_value' => $def['type'],
            'topic' => $request->topic,
        ]);

        /** @var Model */
        $iot_value = $model_class::create([
            'iot_data_id' => $iot_data->id,
            'value' => $data['message']
        ]);

        $iot_value->setRelation('iotData', $iot_data);

        return $iot_value;
    }
}
