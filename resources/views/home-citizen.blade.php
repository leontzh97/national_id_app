@extends('layouts.app')

@section('content')
@desktop
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <h1 class="text-center">Welcome to MyGovernment</h1>
        </div>
        <div class="col-md-8" id="logo" style="height:360;width:360;">
          <img src="{{ asset('images/WP_logo.png') }}" class="mx-auto d-block" alt="myGovernment"><br><br>
        </div>
    </div>
</div>
@elsedesktop
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <h1 class="text-center">Welcome to MyGovernment</h1>
        </div>
        <div class="col-md-8" id="logo" style="height:360;width:360;">
          <img src="{{ asset('images/WP_logo.png') }}" class="mx-auto d-block" alt="myGovernment"><br><br>
        </div><br><br>
        <div class="col-md-8" id="logo" style="height:360;width:360;">
          <img src="" class="mx-auto d-block" alt="qr_code">QR Code<br><br>
        </div>
    </div>
</div>
@enddesktop
@endsection
