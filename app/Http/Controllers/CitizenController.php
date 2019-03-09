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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
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
            'nric' => $nric,
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

          Citizenship::saveNewCitizen($nric);

          return redirect()->route('loading')->with([
            'post' => json_encode($postField)
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
    public function view(Request $request)
    {
        $id = Citizenship::where(['id' => $request->id])->first();

        return View('profile',[
          'user' => $id
        ]);
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
          $id = Citizenship::where(['id' => $request->nric])->first();

          $postField = [
            'nric' => $id->nric,
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

          return redirect()->route('loading')->with([
            'update' => json_encode($postField)
          ]);
        }

        return redirect()->back()->with('fail', 'Server error');
    }

    /**
     * Show the listing
     *
     * @return \Illuminate\Http\Response
     */
    public function listing(Request $request)
    {
        if($request->ajax()){
          $filter = Citizenship::setDataTableFilter($request->all());
          $totalInDB = Citizenship::findCitizenListingWithFilter([], 'count');
          $totalFiltered = Citizenship::findCitizenListingWithFilter(['searchValue' => $filter['searchValue']], 'count');
          $list = Citizenship::displayCitizenTable($filter);

          $recordsTotal = is_object($totalInDB) ? 0 :$totalInDB;

          if(is_object($totalFiltered))
          {
              $recordsFiltered = 0;
          }
          else
          {
              $recordsFiltered = (! empty($filter['searchValue'])) ? $totalFiltered : $recordsTotal;
          }

          $pageResult = [
            'draw'              => $filter['draw'],
            'recordsTotal'      => $recordsTotal,
            'recordsFiltered'   => $recordsFiltered,
            'start'             => $filter['offset'],
            'data'              => $list,
            'length'            => $filter['limit'],
            'searchValue'       => $filter['searchValue']
          ];

          return response()->json($pageResult);
        }
    }

    /**
     * Load all wallet address
     *
     * @return \Illuminate\Http\Response
     */
    public function loadAllCitizen(Request $request)
    {
        return Citizenship::where('nric', 'LIKE', ('%'.$request->q.'%'))
                ->orderBy('nric', 'desc')
                ->paginate(10);
    }
}
