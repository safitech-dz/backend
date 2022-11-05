<?php

namespace App\Http\Controllers;

use App\Packages\IotDataService;
use Illuminate\Http\Request;


class IotDataController extends Controller
{
    public function __invoke(Request $request)
    {
        $iot_data_service = new IotDataService($request);

        return $iot_data_service->getTopicDefinition();
        return $request->all();
    }
}
