@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/qrcode.css') }}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <input id="track" type=text size=16 placeholder="Tracking NRIC" class=qrcode-text>
            <label class=qrcode-text-btn>
              <input type=file accept="image/*" capture=environment
              onclick="return showQRIntro();" onchange="openQRCamera(this);" tabindex=-1></label>
          <input id="search" type="button" value="Search" onclick="isCitizenExist()">
        </div>
        <div class="col-md-8">
          <h4 id="result"></h4>
        </div>
  </div>
</div>

<script>
const CitizenContract = web3.eth.contract(
  {!! config('settings.contract.abi') !!}
);
const Citizen = CitizenContract.at('{{ config('settings.contract.block') }}');

function openQRCamera(node) {
  var reader = new FileReader();
  reader.onload = function() {
    node.value = "";
    qrcode.callback = function(res) {
      if(res instanceof Error) {
        alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
      } else {
        node.parentNode.previousElementSibling.value = res;
      }
    };
    qrcode.decode(reader.result);
  };
  reader.readAsDataURL(node.files[0]);
}

function showQRIntro() {
  return confirm("Use your camera to take a picture of a QR code.");
}

function isCitizenExist(){
  var nric = $('#track').val();
  console.log(nric);
  Citizen.checkIsCitizenExists(web3.fromAscii(nric), function(error, result){
    if(result == true){
      $('#result').text('Citizen Exist');
    }
    else {
      $('#result').text('Citizen Not Exist');
    }
  });
}
</script>
@endsection
