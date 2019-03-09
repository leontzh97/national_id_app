<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use App\User;

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
   * The attributes that are hidden.
   *
   * @var array
   */
  protected $hidden = [
      'remember_token', 'created_at' ,'updated_at'
  ];

  /**
   * Has an user account.
   */
  public function user()
  {
      return $this->hasOne('App\User');
  }

  /**
   * Create a new citizen instance after a valid registration.
   *
   * @param  $data
   * @return \App\Citizenship
   */
  protected function saveNewCitizen($data)
  {
      User::createNewUser($data);

      return Citizenship::create([
        'nric' => $data
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

  /**
   *
   * Set table filter
   *
   */
  protected function setDataTableFilter($request)
  {
      $draw = $request['draw'];
      $start = $request['start'];
      $limit = $request['length'];

      $sort = $request['order'][0]['dir'];
      $sortIndex = $request['order'][0]['column'];
      $sortName = $request['columns'][$sortIndex]['name'];
      $searchValue = $request['search']['value'];

      return [
          'draw'          => $draw,
          'limit'         => $limit,
          'offset'        => $start,
          'sortName'      => $sortName,
          'sort'          => $sort,
          'searchValue'   => $searchValue
      ];

  }

  /**
   * Display for user table
   *
   * @param array $filter
   * @return array
   */
  protected function displayCitizenTable($filter)
  {
     $display = [];
     $listing = self::findCitizenListingWithFilter($filter);

     if(! empty($listing))
     {
         foreach($listing as $value)
         {
             array_push($display, [
                 'id'                => $value->id,
                 'nric'              => $value->nric,
                 'action'            => '<button onClick="window.location.href=\''.route('nric.view',['id' => $value->id]).'\' " class="btn btn-ghost-primary"><i class="fa fa-eye"></i> View</button>'
             ]);
         }
     }

     return $display;
   }

   /**
    * Find user listing with filter
    *
    * @param array $filter
    * @param string $type [count / get]
    * @return array
    */
   protected function findCitizenListingWithFilter($filter, $type='get')
   {
       $searchValue = array_key_exists('searchValue', $filter) ? $filter['searchValue'] : null;
       $sortBy = array_key_exists('sortName', $filter) ? $filter['sortName'] : null;
       $sort = array_key_exists('sort', $filter) ? $filter['sort'] : null;
       $limit = array_key_exists('limit', $filter) ? $filter['limit'] : null;
       $offset = array_key_exists('offset', $filter) ? $filter['offset'] : null;

       return DB::table('citizenships')
               ->select('citizenships.id', 'citizenships.nric')
               ->when($searchValue, function($query, $searchValue) {
                   return $query->where('citizenships.id', 'LIKE', ('%'.$searchValue.'%'))
                                ->orWhere('citizenships.nric', 'LIKE', ('%'.$searchValue.'%'));
               })
               ->when($sortBy, function($query, $sortBy) use ($sort) {
                   return $query->orderBy($sortBy, $sort);
               })
               ->when($limit, function($query, $limit) {
                   return $query->limit($limit);
               })
               ->when($offset, function($query, $offset) {
                   return $query->offset($offset);
               })
               ->when($type == 'count', function($query, $type) {
                   return $query->count();
               }, function($query) {
                   return $query->get();
               });
   }
}
