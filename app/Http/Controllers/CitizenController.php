<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Citizenship;
use Carbon\Carbon;

class CitizenController extends Controller
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
    public function create(Request $request)
    {
        $action = $request->action;
        return view('manage.register',[
          'action' => $action
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:citizenships',
            'email' => 'required|string|email|max:255|unique:citizenships',
            'race' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'address2' => 'string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|integer',
            'dob' => 'required|date|max:255',
            'license' => 'string|max:255',
            'expiry_date' => 'date|max:255',
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = self::validator($request->all());

        if($validation->fails()){
          return redirect()->back()->withInput()->withErrors($validation->errors());
        }
        else{

          foreach(config('settings.state.all') as $k => $v){
            if($request->state == $v){
              $state = $k;
            }
          };

          $dob = Carbon::parse($request->dob)->format('ymd');
          $nric = Citizenship::generateNewNRIC($dob,$state,$request->gender);

          $postField = [
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
            'nric' => $nric,
            'driving_license' => ($request->license) ? $request->license : null,
            'driver_expiry_date' => ($request->expiry_date) ? $request->expiry_date : null
          ];

          Citizenship::saveNewCitizen($postField);

          return redirect()->back()->with([
            'success' => 'Citizen has been created',
            'nric' => $nric,
          ]);
        }

        return redirect()->back()->with('fail', 'Server error');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
      $action = $request->action;
      return view('manage.update',[
        'action' => $action
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Citizenship::where(['id' => $request->nric])->first();

        if(!empty($id)){
          $id->email = ($request->email) ? $request->email : $id->email;
          $id->gender = ($request->gender) ? $request->gender : $id->gender;
          $id->address_1 = ($request->address) ? $request->address : $id->address_1;
          $id->address_2 = ($request->address2) ? $request->address2 : $id->address_2;
          $id->city = ($request->city) ? $request->city : $id->city;
          $id->state = ($request->state) ? $request->state : $id->state;
          $id->zip = ($request->zip) ? $request->zip : $id->zip;

          // if($id->driving_license == null){
          //   $id->driving_license = ($request->license) ? $request->license : $id->null;
          //   $id->driver_expiry_date = ($request->expiry_date) ? $request->expiry_date : null;
          // }
          // else{
            $id->driving_license = ($request->license) ? $request->license : $id->driving_license;
            $id->driver_expiry_date = ($request->expiry_date) ? $request->expiry_date : $id->driver_expiry_date;
          // }

          $id->save();

          return redirect()->home();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Load all wallet address
     *
     * @return \Illuminate\Http\Response
     */
    public function loadAllCitizen(Request $request)
    {
        return Citizenship::where('nric', 'LIKE', ('%'.$request->q.'%'))
                ->orWhere('name', 'LIKE', ('%'.$request->q.'%'))
                ->orderBy('name', 'asc')
                ->paginate(10);
    }
}
