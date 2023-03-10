<?php

namespace App\Services\Version_1\Utils;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Auth;

class GetEmailFromToken
{
    public static function getEmailFromToken(String $token)
    {
        //used for authenticated users only
        // i.e., given that the token is valid

        //get email from auths table via token
        $resultSet = DB::select('select * from auths where token = ?', [$token]);

        return (string) $resultSet[0]->email;
    }
}