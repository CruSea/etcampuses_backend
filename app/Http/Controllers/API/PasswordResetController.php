<?php

namespace App\Http\Controllers\API;

use App\Models\PasswordResetModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Notifications\PasswordReset2;
use App\Models\CampusAdmin;
use Illuminate\Support\Facades\Cache;


class PasswordResetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //method called when user requests password reset

        //check if email exists in campusadmin table
        $resultSet = DB::scalar('select email from campusadmin where email = ?', [$request->input('email')]);
        if(empty($resultSet)){
            return response()->json([
                'status' => 404,
                'message' => 'Email does not exist!',
            ]);
        }
        

        $resetKey = (string) Str::uuid();

        //save to cache
        Cache::put($resetKey, $request->input('email'), $seconds = 900); //900 seconds = 15 minutes

        //send email
        //get model first
        $campusAdmin = CampusAdmin::where('email', $request->input('email'))->first();

        $campusAdmin->notify(new PasswordReset2($campusAdmin, $resetKey));


        return response()->json([
            'status' => 200,
            'message' => 'Password Reset Requested Successfully!' 
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PasswordResetModel  $passwordReset
     * @return \Illuminate\Http\Response
     */
    public function show(PasswordResetModel $passwordReset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PasswordResetModel  $passwordReset
     * @return \Illuminate\Http\Response
     */
    public function edit(PasswordResetModel $passwordReset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PasswordResetModel  $passwordReset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PasswordResetModel $passwordReset)
    {
        //method called when password is reset

        $newPassword = $request->input('newPassword');
        $confirmPassword = $request->input('confirmPassword');

        //old method
        //$resultSet = DB::scalar('select email from password_resets where resetKey = ?', [$request->resetKey]);      
        
        //new method
        

        if (Cache::has($request->resetKey)) {
            //retierieve and delete data from cache
            $email = Cache::pull($request->resetKey);

            if($newPassword == $confirmPassword){
                DB::update('update campusadmin set password = ? where email = ?', [$newPassword, $email]);            

                return response()->json([
                    'status' => 200,
                    'message' => 'Password is successfully reset!' 
                ]);
            }
            else{
                return response()->json([
                    'status' => 422,
                    'message' => 'Passwords do not match!' 
                ]);
            }

        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'URL expired or does not exist!',
            ]);
        }
    
        //Old approach

        // if(empty($resultSet)){        
        //     return response()->json([
        //         'status' => 404,
        //         'message' => 'URL expired or does not exist!',
        //     ]);
        // }
        // else{
            
        //     if($newPassword == $confirmPassword){
        //         DB::update('update campusadmin set password = ? where email = ?', [$newPassword, $resultSet]);

        //         //clean up the password reset table        
        //         DB::table('password_resets')->where('email', '=', $resultSet)->delete();

        //         return response()->json([
        //             'status' => 200,
        //             'message' => 'Password is successfully reset!' 
        //         ]);
        //     }
        //     else{
        //         return response()->json([
        //             'status' => 422,
        //             'message' => 'Passwords do not match!' 
        //         ]);
        //     }

        // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PasswordResetModel  $passwordReset
     * @return \Illuminate\Http\Response
     */
    public function destroy(PasswordResetModel $passwordReset)
    {
        //
    }
}
