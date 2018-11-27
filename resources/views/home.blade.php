@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <h1 class="text-center">Welcome to MyGovernment</h1>
        </div>
        <div class="col-md-8" id="logo" style="height:360;width:360;">
          <img src="{{ asset('images/WP_logo.png') }}" class="mx-auto d-block" alt="myGovernment">
        </div>
    </div>
</div>
@endsection
