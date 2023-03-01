<?php

namespace App\Http\Controllers\API\Version_1\View_Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Version_1\View_Campus\View_Campus;

class ViewCampusController extends Controller
{
    public function view_Campus(Request $request, String $campusURL)
    {
        $viewCampusService = new View_Campus();
        
        return $viewCampusService->handle($request, $campusURL);
    }

}