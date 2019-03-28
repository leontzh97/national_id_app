<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($nric)
    {
        $user = User::where(['username' => $nric])->first();

        if($user){
          return View('api.profile',[
            'nric' => $user->username
          ]);
        }

        return response()->json([
          'message' => 'User not found'
        ],404);
    }

    /**
     * Show the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
      if($request->nric){
        $postField = [
          'nric' => $request->nric,
          'name' => $request->name,
          'email' => $request->email,
          'race' => $request->race,
          'gender' => $request->gender,
          'address_1' => $request->address,
          'address_2' => $request->address2,
          'city' => $request->city,
          'state' => $request->state,
          'zip' => $request->zip,
          'date_of_birth' => $request->dob,
          'driving_license' => ($request->license) ? $request->license : null,
          'driver_expiry_date' => ($request->expiry_date) ? $request->expiry_date : null
        ];

        return $postField;
      }

      return response()->json([
        'message' => 'User not found'
      ],404);
    }
}
