<?php

namespace App\Services\Version_1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Auth;

class UserLogin
{
    public function handle(Request $request)
    {
        // add the user to the auths table
        $auths = new Auth();
    }
}