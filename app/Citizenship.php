<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class Citizenship extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'email', 'nric', 'race', 'gender',
      'address_1', 'address_2', 'city', 'state', 'zip',
      'date_of_birth', 'driving_license', 'driver_expiry_date'
  ];

  /**
   * Create a new citizen instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\Citizenship
   */
  protected function saveNewCitizen($data)
  {
      return Citizenship::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'nric' => $data['nric'],
        'race' => $data['race'],
        'gender' => $data['gender'],
        'address_1' => $data['address_1'],
        'address_2' => $data['address_2'],
        'city' => $data['city'],
        'state' => $data['state'],
        'zip' => $data['zip'],
        'date_of_birth' => $data['date_of_birth'],
        'driving_license' => $data['driving_license'],
        'driver_expiry_date' => $data['driver_expiry_date']
      ]);
  }

  /**
   * Find citizen by ID
   *
   * @param
   * @return array
   */
  protected function findCitizenByNRIC($nric)
  {
      return DB::table('citizenships')
              ->where([
                  'nric' => $nric
              ])
              ->first();
  }

  /**
   * Generate a unique nric
   *
   * @return string nric
   */
  protected function generateNewNRIC($dob, $state, $gender)
  {
      $num = mt_rand(0,9999);
      if($gender == 'M'){
        $rand_num = $num | 1;
      }
      else {
        $rand_num = $num & ~1;
      }
      $nric = $dob.$state.sprintf('%04d', $rand_num);
      $found = self::findCitizenByNRIC($nric);

      if(empty($found)){
          return $nric;
      }

      return self::generateNewNRIC($dob, $state, $gender);
  }
}
