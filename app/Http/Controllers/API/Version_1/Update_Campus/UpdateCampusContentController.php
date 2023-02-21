<?php

namespace App\Http\Controllers\API\Version_1\Update_Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Version_1\Update_Campus\Update_About_Section;
use App\Services\Version_1\Update_Campus\Update_City_Section;
use App\Services\Version_1\Update_Campus\Update_Fellowship_Section;
use App\Services\Version_1\Update_Campus\Update_Footer_Section;
use App\Services\Version_1\Update_Campus\Update_Intro_Section;
use App\Services\Version_1\Update_Campus\Update_Registration_Section;
use App\Services\Version_1\Update_Campus\Update_Social_Section;
use App\Services\Version_1\Update_Campus\Update_Welcome_Section;

class UpdateCampusContentController extends Controller
{
    public function update_About_Section(Request $request, Update_About_Section $updateAboutSection)
    {
        return $updateAboutSection->handle($request);
    }

    public function update_City_Section(Request $request, Update_City_Section $updateCitySection)
    {
        return $updateCitySection->handle($request);
    }

    public function update_Fellowship_Section(Request $request, Update_Fellowship_Section $updateFellowshipSection)
    {
        return $updateFellowshipSection->handle($request);
    }

    public function update_Footer_Section(Request $request, Update_Footer_Section $updateFooterSection)
    {
        return $updateFooterSection->handle($request);
    }

    public function update_Intro_Section(Request $request, Update_Intro_Section $updateIntroSection)
    {
        return $updateIntroSection->handle($request);
    }

    public function update_Registration_Section(Request $request, Update_Registration_Section $updateRegistrationSection)
    {
        return $updateRegistrationSection->handle($request);
    }

    public function update_Social_Section(Request $request, Update_Social_Section $updateSocialSection)
    {
        return $updateSocialSection->handle($request);
    }

    public function update_Welcome_Section(Request $request, Update_Welcome_Section $updateWelcomeSection)
    {
        return $updateWelcomeSection->handle($request);
    }
}