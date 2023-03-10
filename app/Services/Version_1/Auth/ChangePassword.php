<?php

namespace App\Services\Version_1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Services\Version_1\Utils\GetEmailFromToken;

class ChangePassword
{
    public function handle(Request $request)
    {
            $currentPassword = DB::scalar('select password from users where email = ?', [GetEmailFromToken::getEmailFromToken($request->token)]);
            if($request->oldPassword == $currentPassword){
                if($request->newPassword == $request->confirmPassword){

                    //update password
                    $user = User::where('email', GetEmailFromToken::getEmailFromToken($request->token))->first();
                    $user->password = $request->newPassword;
                    $user->save();

                    return response()->json([
                        'status' => 200,
                        'message' => 'Password is changed successfully!'
                    ]);

                }
                else{
                    return response()->json([
                        'status' => 403,
                        'message' => 'New Password and Confirm Password do not match!'
                    ]);
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