@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="text-center"><h1>Welcome to MyGovernment</h1></div>
            @desktop
            <div id="logo">
              <img src="{{ asset('images/government.png') }}" width="360" height="360" class="mx-auto d-block" alt="myGovernment"><br><br>
            </div>
            @elsedesktop
            <div id="logo">
              <img src="{{ asset('images/government.png') }}" width="180" height="180" class="mx-auto d-block" alt="myGovernment"><br><br>
            </div>
            @enddesktop
            <div class="panel">
                <div class="panel-header text-center">
                  <h4><i class="fa fa-lock"></i> Enter your credentials below to <strong>Log In</strong></h4>
                </div>
                <div class="panel-body justify-content-center">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row text-center">
                            <label for="username" class="col-sm-3 col-form-label text-md-right"><strong>{{ __('Username:') }}</strong></label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                  name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row text-center">
                            <label for="pw" class="col-sm-3 col-form-label text-md-right"><strong>{{ __('Password:') }}</strong></label>

                            <div class="col-md-6">
                                <input id="pw" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                  name="password" value="{{ old('password') }}" required autofocus>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0 text-center">
                          <div class="col-md-6 offset-md-3">
                              <button type="submit" class="btn text-white" style="background-color: #1BBAAE; width:100%;">
                                  {{ __('Login') }}
                              </button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
