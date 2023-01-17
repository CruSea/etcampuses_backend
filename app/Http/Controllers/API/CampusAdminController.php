<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CampusAdmin;
use Illuminate\Support\Facades\DB;

class CampusAdminController extends Controller
{
    public function store(Request $request){
        $campusAdmin = new CampusAdmin();
        $campusAdmin->firstName = $request->input('firstName');
        $campusAdmin->lastName = $request->input('lastName');
        $campusAdmin->email = $request->input('email');
        $campusAdmin->password = $request->input('password');
        $campusAdmin->phone = $request->input('phone');
        $campusAdmin->approvedBy = $request->input('approvedBy');
        $campusAdmin->save();

        return response()->json([
            'status' => 200,
            'message' => 'Campus Admin Created Successfully!' 
        ]);
    }

    public function authenticate(Request $request){
        $resultSet = DB::select('select * from campusadmin where email = ? and password = ?', [$request->email,$request->password]);
        if(empty($resultSet)){        
            return response()->json([
                'status' => 403,
                'message' => 'Incorrect email or password!' 
            ]);
        }
        else{
            return response()->json([
                'status' => 200,
                'message' => 'Authentication successful!' 
            ]);
        }
    }
}
