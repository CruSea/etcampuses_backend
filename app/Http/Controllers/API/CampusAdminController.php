<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CampusAdmin;
use Illuminate\Support\Facades\DB;

class CampusAdminController extends Controller
{
    public function create(String $firstName, String $lastName, String $email, String $password, String $phone, String $campusID, String $approvedBy){ 
        // create campus admin
        $campusAdmin = new CampusAdmin();
        $campusAdmin->firstName = $firstName;
        $campusAdmin->lastName = $lastName;
        $campusAdmin->email = $email;
        $campusAdmin->password = $password;
        $campusAdmin->phone = $phone;
        $campusAdmin->campusID = $campusID;
        $campusAdmin->approvedBy = $approvedBy;
        $campusAdmin->save();

        return response()->json([
            'status' => 200,
            'message' => 'Campus Admin Created Successfully!' 
        ]);
    }

    public function authenticate(Request $request){ // authentication -> login
        
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
            return response()->json([
                'status' => 200,
                'message' => 'Already Logged in!'
            ]);
        }

        $resultSet = DB::select('select * from campusadmin where email = ? and password = ?', [$request->email,$request->password]);
        if(empty($resultSet)){        
            return response()->json([
                'status' => 403,
                'message' => 'Incorrect email or password!' 
            ]);
        }
        else{
            //save session        
            $request->session()->put('userEmail', $request->email);

            return response()->json([
                'status' => 200,
                'message' => 'Authentication successful!' 
            ]);
        }
    }

    public function logOut(Request $request){

        //check if session exsists
        if ($request->session()->exists('userEmail')) {
            
            $email = $request->session()->pull('userEmail', 'null');

            return response()->json([
                'status' => 200,
                'message' => 'Log out successful!'
                //'user logged out' => $email,
            ]);

        }
        else{

            return response()->json([
                'status' => 200,
                'message' => 'Not Logged in!'
            ]);

        }

    }

    public function changePassword(Request $request){

        //authenticate
        if ($request->session()->exists('userEmail')) {
            $currentPassword = DB::scalar('select password from campusadmin where email = ?', [$request->session()->get('userEmail')]);
            if($request->oldPassword == $currentPassword){
                if($request->newPassword == $request->confirmPassword){
                    $affected = DB::update('update campusadmin set password = ? where email = ?', [$request->newPassword, $request->session()->get('userEmail')]);
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
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!'
            ]);
        }
    }

}
