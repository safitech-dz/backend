<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IotDataController extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->all();
    }
}
