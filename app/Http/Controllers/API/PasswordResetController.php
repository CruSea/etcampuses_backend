<?php

namespace App\Http\Controllers\API;

use App\Models\PasswordResetModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

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
        $passwordReset = new PasswordResetModel();
        $passwordReset->key = (string) Str::uuid();
        $passwordReset->email = $request->input('email');
        $passwordReset->save();

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
        //
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
