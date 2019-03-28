<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\User;

class PasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show change password screen.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.editPassword');
    }

    /**
     * Change password function.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request){

        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("errors","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('old_password'), $request->get('password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("errors","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => array(
                'required',
                'min:6',
                'confirmed'
            ),
        ])->validate();

          $user = Auth::user();
          $user->password = Hash::make($request->get('password'));
          $user->save();
          return redirect()->back()->with("success","Password changed successfully !");

    }
}
