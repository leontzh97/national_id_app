@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header"><h1 class="text-center">{{ $user->name }}'s Profile</h1></div>
            <div class="card-body">
              <div class="form-group">
                <label for="nric"><strong>NRIC</strong></label>
                <input type="text" class="form-control" value="{{ $user->nric }}" readonly>
              </div>
              <div class="form-group">
                <label for="name"><strong>Name</strong></label>
                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
              </div>
              <div class="form-group">
                <label for="email"><strong>Email</strong></label>
                <input type="text" class="form-control" value="{{ $user->email }}" readonly>
              </div>
              <div class="form-group">
                <label for="race"><strong>Race</strong></label>
                <input type="text" class="form-control" value="{{ $user->race }}" readonly>
              </div>
              <div class="form-group">
                <label for="gender"><strong>Gender</strong></label>
                <input type="text" class="form-control" value="{{ $user->gender }}" readonly>
              </div>
              <div class="form-group">
                <label for="dob"><strong>Date Of Birth</strong></label>
                <input type="text" class="form-control" value="{{ $user->date_of_birth }}" readonly>
              </div>
              <div class="form-group">
                <label for="address"><strong>Address 1</strong></label>
                <input type="text" class="form-control" value="{{ $user->address_1 }}" readonly>
              </div>
              <div class="form-group">
                <label for="address2"><strong>Address 2</strong></label>
                <input type="text" class="form-control" value="{{ $user->address_2 }}" readonly>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="city"><strong>City</strong></label>
                  <input type="text" class="form-control" value="{{ $user->city }}" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label for="state"><strong>State</strong></label>
                  <input type="text" class="form-control" value="{{ $user->state }}" readonly>
                </div>
                <div class="form-group col-md-2">
                  <label for="zip"><strong>Zip</strong></label>
                  <input type="text" class="form-control" value="{{ $user->zip }}" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
