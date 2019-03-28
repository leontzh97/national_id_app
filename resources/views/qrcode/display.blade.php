@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center" id="qrcode">
          {!! QrCode::size(230)->generate(Auth::user()->username) !!}
          <br><br><h3 class="text-center">Scan Me</h3>
        </div>
    </div>
</div>
@endsection
