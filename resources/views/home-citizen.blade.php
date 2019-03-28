@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <h1 class="text-center">Welcome to MyGovernment</h1>
        </div>
        @desktop
        <div class="col-md-8" id="logo">
          <img src="{{ asset('images/government.png') }}" width="360" height="360" class="mx-auto d-block" alt="myGovernment"><br><br>
        </div>
        @elsedesktop
        <div class="col-md-8" id="logo">
          <img src="{{ asset('images/government.png') }}" width="180" height="180" class="mx-auto d-block" alt="myGovernment"><br><br>
        </div>
        <div class="col-md-8 text-center">
          <a class="btn text-white" style="background-color: #1BBAAE; width:100%;" href="{{ route('qr.scan')}}">Scan Now</a>
        </div><br><br>
        <div class="col-md-8 text-center">
          <a class="btn text-white" style="background-color: #1BBAAE; width:100%;" href="{{ route('qr.display')}}">My QRCode</a>
        </div>
        @enddesktop
    </div>
</div>
@endsection
