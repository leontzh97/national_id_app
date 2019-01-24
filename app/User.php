<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'role', 'citizen_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Belongs to a citizen.
     */
    public function citizenship()
    {
        return $this->belongsTo('App\Citizenship');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param $ic
     * @return \App\Citizenship
     */
    protected function createNewUser($ic)
    {
        return User::create([
          'username' => $ic,
          'password' => Hash::make($ic),
          'role' => 'citizen',
        ]);
    }
}
