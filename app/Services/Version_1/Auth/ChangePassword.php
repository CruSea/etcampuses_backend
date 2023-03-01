<?php

namespace App\Services\Version_1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChangePassword
{
    public function handle(Request $request)
    {
        $currentPassword = DB::scalar('select password from users where email = ?', [$request->session()->get('userEmail')]);
            if($request->oldPassword == $currentPassword){
                if($request->newPassword == $request->confirmPassword){
                    $affected = DB::update('update users set password = ? where email = ?', [$request->newPassword, $request->session()->get('userEmail')]);
                    if($affected == 1){
                        return response()->json([
                            'status' => 200,
                            'message' => 'Password is changed successfully!'
                        ]);
                    }
                    else{
                        return response()->json([
                            'status' => 500,
                            'message' => 'Unable to change password!'
                        ]);
                    }
                }
            }
            else{
                return response()->json([
                    'status' => 403,
                    'message' => 'Old Password incorrect!'
                ]);
            }
    }
}