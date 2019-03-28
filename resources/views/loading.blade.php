@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8" id="loading">
        <img src="{{ asset('images/loading.gif') }}" width="360" height="360" class="mx-auto d-block" alt="loading"><br><br>
      </div>
      <h2 id="proceed">Complete The Action In Metamask To Proceed...</h2>
    </div>
    <form id="register-form" action="{{ route('nric.register',['data' => json_decode(session('post'),true)]) }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

<script>
var CitizenContract = web3.eth.contract(
  {!! config('settings.contract.abi') !!}
);
var Citizen = CitizenContract.at('{{ config('settings.contract.block') }}');

if('{!! session('post') !!}'){
  console.log('post');
  var reg = JSON.parse('{!! session('post') !!}');
}
else{
  console.log('update');
  var up = JSON.parse('{!! session('update') !!}');
}

console.log(up);
console.log(reg);
if(reg){
  var ic = web3.fromAscii(reg.nric);
  if(reg.driving_license == null){
    console.log('no driving');
    var info = [
        web3.fromAscii(reg.name),web3.fromAscii(reg.email),
        web3.fromAscii(reg.race),web3.fromAscii(reg.gender),
        web3.fromAscii(reg.address_1),web3.fromAscii(reg.address_2),
        web3.fromAscii(reg.city),web3.fromAscii(reg.state),
        web3.fromAscii(reg.zip),web3.fromAscii(reg.date_of_birth),
        web3.fromAscii('null'),web3.fromAscii('null')
    ];
  }
  else{
    var info = [
        web3.fromAscii(reg.name),web3.fromAscii(reg.email),
        web3.fromAscii(reg.race),web3.fromAscii(reg.gender),
        web3.fromAscii(reg.address_1),web3.fromAscii(reg.address_2),
        web3.fromAscii(reg.city),web3.fromAscii(reg.state),
        web3.fromAscii(reg.zip),web3.fromAscii(reg.date_of_birth),
        web3.fromAscii(reg.driving_license),web3.fromAscii(reg.driver_expiry_date)
    ];
  }

  Citizen.registerCitizen(ic, info, function(error,result){
    if(error){
      console.error(error);
      $('#loading').hide();
      $('#proceed').text('You Have Rejected The Transaction');
      window.setTimeout(function () {
          location.href = "{{ route('home') }}";
      }, 1000);
    }
    else {
      $('#register-form').submit();
      console.log(result);
    }
  });
}

if(up){
  var ic = web3.fromAscii(up.nric);
  if(up.driving_license == null){
    console.log('no driving');
    var info = [
        web3.fromAscii(up.name),web3.fromAscii(up.email),
        web3.fromAscii(up.race),web3.fromAscii(up.gender),
        web3.fromAscii(up.address_1),web3.fromAscii(up.address_2),
        web3.fromAscii(up.city),web3.fromAscii(up.state),
        web3.fromAscii(up.zip),web3.fromAscii(up.date_of_birth),
        web3.fromAscii('null'),web3.fromAscii('null')
    ];
  }
  else{
    var info = [
        web3.fromAscii(up.name),web3.fromAscii(up.email),
        web3.fromAscii(up.race),web3.fromAscii(up.gender),
        web3.fromAscii(up.address_1),web3.fromAscii(up.address_2),
        web3.fromAscii(up.city),web3.fromAscii(up.state),
        web3.fromAscii(up.zip),web3.fromAscii(up.date_of_birth),
        web3.fromAscii(up.driving_license),web3.fromAscii(up.driver_expiry_date)
    ];
  }

  Citizen.updateCitizen(ic, info, function(error,result){
    if(error){
      console.error(error);
      $('#loading').hide();
      $('#proceed').text('You Have Rejected The Transaction');
      window.setTimeout(function () {
          location.href = "{{ route('home') }}";
      }, 1000);
    }
    else {
      console.log(result);
      window.setTimeout(function () {
          location.href = "{{ route('home') }}";
      }, 1000);
    }
  });
}
</script>
@endsection
