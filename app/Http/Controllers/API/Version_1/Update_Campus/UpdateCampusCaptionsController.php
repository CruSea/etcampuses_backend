<?php

namespace App\Http\Controllers\API\Version_1\Update_Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Version_1\Update_Campus\Update_Campus_Captions;

class UpdateCampusCaptionsController extends Controller
{
    public function update_Gallery_Title(Request $request, Update_Campus_Captions $update_Campus_Captions)
    {
        return $update_Campus_Captions->update_Gallery_Title($request);
    }

    public function update_Services_Title(Request $request, Update_Campus_Captions $update_Campus_Captions)
    {
        return $update_Campus_Captions->update_Services_Title($request);
    }

    public function update_Teams_Title(Request $request, Update_Campus_Captions $update_Campus_Captions)
    {
        return $update_Campus_Captions->update_Teams_Title($request);
    }

    public function update_Teams_Description(Request $request, Update_Campus_Captions $update_Campus_Captions)
    {
        return $update_Campus_Captions->update_Teams_Description($request);
    }

    public function update_Leaders_Title(Request $request, Update_Campus_Captions $update_Campus_Captions)
    {
        return $update_Campus_Captions->update_Leaders_Title($request);
    }

    public function update_Leaders_BgColor(Request $request, Update_Campus_Captions $update_Campus_Captions)
    {
        return $update_Campus_Captions->update_Leaders_BgColor($request);
    }
}