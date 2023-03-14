<?php

namespace App\Http\Controllers\API\Version_1\View_Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Version_1\View_Campus\View_Campus;
use App\Services\Version_1\View_Campus\View_Campus_Public;

class ViewCampusController extends Controller
{
    public function view_Campus(Request $request)
    {
        $viewCampusService = new View_Campus();
        
        return $viewCampusService->handle($request);
    }

    public function view_Campus_Public(Request $request, String $campusURL)
    {
        $viewCampusService2 = new View_Campus_Public();
        
        return $viewCampusService2->handle($request, $campusURL);
    }

}