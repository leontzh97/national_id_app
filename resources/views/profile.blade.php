@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header"><h1 class="text-center" id="header"></h1></div>
            <div class="card-body">
              <div class="form-group">
                <label for="nric"><strong>NRIC</strong></label>
                <input type="text" class="form-control" value="{{ $user->nric }}" readonly>
              </div>
              <div class="form-group">
                <label for="name"><strong>Name</strong></label>
                <input type="text" class="form-control" id="name" readonly>
              </div>
              <div class="form-group">
                <label for="email"><strong>Email</strong></label>
                <input type="text" class="form-control" id="email" readonly>
              </div>
              <div class="form-group">
                <label for="race"><strong>Race</strong></label>
                <input type="text" class="form-control" id="race" readonly>
              </div>
              <div class="form-group">
                <label for="gender"><strong>Gender</strong></label>
                <input type="text" class="form-control" id="gender" readonly>
              </div>
              <div class="form-group">
                <label for="dob"><strong>Date Of Birth</strong></label>
                <input type="text" class="form-control" id="dob" readonly>
              </div>
              <div class="form-group">
                <label for="address"><strong>Address 1</strong></label>
                <input type="text" class="form-control" id="address" readonly>
              </div>
              <div class="form-group">
                <label for="address2"><strong>Address 2</strong></label>
                <input type="text" class="form-control" id="address2" readonly>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="city"><strong>City</strong></label>
                  <input type="text" class="form-control" id="city" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label for="state"><strong>State</strong></label>
                  <input type="text" class="form-control" id="state" readonly>
                </div>
                <div class="form-group col-md-2">
                  <label for="zip"><strong>Zip</strong></label>
                  <input type="text" class="form-control" id="zip" readonly>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="form-group">
                <label for="driving_license"><strong>Driving License</strong></label>
                <input type="text" class="form-control" id="driving_license" readonly>
              </div>
              <div class="form-group">
                <label for="driver_expiry_date"><strong>Expiry Date</strong></label>
                <input type="text" class="form-control" id="driver_expiry_date" readonly>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<script>
var CitizenContract = web3.eth.contract(
  {!! config('settings.contract.abi') !!}
);
var Citizen = CitizenContract.at('{{ config('settings.contract.block') }}');

Citizen.getName(web3.fromAscii('{{ $user->nric }}'),function(error,result){
  if(result){
    var name = web3.toUtf8(result);
    $('#header').text(name + '\'s Profile');
    $('#name').val(name);
  }}
);

Citizen.getEmail(web3.fromAscii('{{ $user->nric }}'),function(error,result){
  if(result){
    var email = web3.toUtf8(result);
    $('#email').val(email);
  }}
);

Citizen.getGender(web3.fromAscii('{{ $user->nric }}'),function(error,result){
  if(result){
    var gender = web3.toUtf8(result);
    $('#gender').val(gender);
  }}
);

Citizen.getRace(web3.fromAscii('{{ $user->nric }}'),function(error,result){
  if(result){
    var race = web3.toUtf8(result);
    $('#race').val(race);
  }}
);

Citizen.getDOB(web3.fromAscii('{{ $user->nric }}'),function(error,result){
  if(result){
    var dob = web3.toUtf8(result);
    $('#dob').val(dob);
  }}
);

Citizen.getAddress1(web3.fromAscii('{{ $user->nric }}'),function(error,result){
  if(result){
    var address_1 = web3.toUtf8(result);
    $('#address').val(address_1);
  }}
);

Citizen.getAddress2(web3.fromAscii('{{ $user->nric }}'),function(error,result){
  if(result){
    var address_2 = web3.toUtf8(result);
    $('#address2').val(address_2);
  }}
);

Citizen.getCity(web3.fromAscii('{{ $user->nric }}'),function(error,result){
  if(result){
    var city = web3.toUtf8(result);
    $('#city').val(city);
  }}
);

Citizen.getState(web3.fromAscii('{{ $user->nric }}'),function(error,result){
  if(result){
    var state = web3.toUtf8(result);
    $('#state').val(state);
  }}
);

Citizen.getZIP(web3.fromAscii('{{ $user->nric }}'),function(error,result){
  if(result){
    var zip = web3.toUtf8(result);
    $('#zip').val(zip);
  }}
);

Citizen.getDrivingLicense(web3.fromAscii('{{ $user->nric }}'),function(error,result){
  if(result){
    var driving_license = web3.toUtf8(result);
    $('#driving_license').val(driving_license);
  }}
);

Citizen.getDriverExpiryDate(web3.fromAscii('{{ $user->nric }}'),function(error,result){
  if(result){
    var driver_expiry_date = web3.toUtf8(result);
    $('#driver_expiry_date').val(driver_expiry_date);
  }}
);
</script>
@endsection
