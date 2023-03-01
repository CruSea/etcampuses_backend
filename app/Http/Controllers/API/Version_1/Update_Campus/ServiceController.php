<?php

namespace App\Http\Controllers\API\Version_1\Update_Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Version_1\Service_Management\Create_Service;
use App\Services\Version_1\Service_Management\Get_Services;
use App\Services\Version_1\Service_Management\Update_Service;
use App\Services\Version_1\Service_Management\Delete_Service;


class ServiceController extends Controller
{
    public function create_Service(Request $request, Create_Service $createService)
    {
        return $createService->handle($request);
    }

    public function get_Services(Request $request, Get_Services $getServices)
    {
        return $getServices->handle($request);
    }

    public function update_Service(Request $request, Update_Service $updateService)
    {
        return $updateService->handle($request);
    }

    public function delete_Service(Request $request, Delete_Service $deleteService)
    {
        return $deleteService->handle($request);
    }
}