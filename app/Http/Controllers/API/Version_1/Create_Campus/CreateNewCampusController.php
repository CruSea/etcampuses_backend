<?php

namespace App\Http\Controllers\API\Version_1\Create_Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Version_1\Create_Campus\Create_Campus;

class CreateNewCampusController extends Controller
{
    public function create_New_Campus(Request $request, Create_Campus $createCampus)
    {
        return $createCampus->handle($request);
    }
}