<?php

namespace App\Http\Controllers\API\Version_1\Update_Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Version_1\Team_Management\Create_Team;
use App\Services\Version_1\Team_Management\Get_Teams;
use App\Services\Version_1\Team_Management\Update_Team;
use App\Services\Version_1\Team_Management\Delete_Team;


class TeamController extends Controller
{
    public function create_Team(Request $request, Create_Team $createTeam)
    {
        return $createTeam->handle($request);
    }

    public function create_Team_Multiple(Request $request, Create_Team $createTeam)
    {
        return $createTeam->handleMultiple($request);
    }

    public function get_Teams(Request $request, Get_Teams $getTeams)
    {
        return $getTeams->handle($request);
    }

    public function update_Team(Request $request, Update_Team $updateTeam)
    {
        return $updateTeam->handle($request);
    }

    public function delete_Team(Request $request, Delete_Team $deleteTeam)
    {
        return $deleteTeam->handle($request);
    }

    public function delete_Team_Multiple(Request $request, Delete_Team $deleteTeam)
    {
        return $deleteTeam->handleMultiple($request);
    }
}