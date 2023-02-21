<?php

namespace App\Http\Controllers\API\Version_1\Update_Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Version_1\Leader_Management\Create_Leader;
use App\Services\Version_1\Leader_Management\Get_Leaders;
use App\Services\Version_1\Leader_Management\Update_Leader;
use App\Services\Version_1\Leader_Management\Delete_Leader;


class LeaderController extends Controller
{
    public function create_Leader(Request $request, Create_Leader $createLeader)
    {
        return $createLeader->handle($request);
    }

    public function get_Leaders(Request $request, Get_Leaders $getLeaders)
    {
        return $getLeaders->handle($request);
    }

    public function update_Leader(Request $request, Update_Leader $updateLeader)
    {
        return $updateLeader->handle($request);
    }

    public function delete_Leader(Request $request, Delete_Leader $deleteLeader)
    {
        return $deleteLeader->handle($request);
    }
}