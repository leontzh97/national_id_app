@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}<br>NRIC: {{ session('nric') }}
      </div>
      @endif
      @if(session('errors'))
      <div class="alert alert-danger" role="alert">
         Please correct the certain field to proceed
      </div>
      @endif
      <div class="col-md-12">
        <h1>{{ $action }} Citizen</h1>
      </div>
      <div class="col-md-12">
        <form id="registration" method="post" action="{{ route('nric.store') }}">
          @csrf
          <div class="card">
            <div class="card-body bg-light">
              <div class="form-group">
                <label for="name"><strong>Name</strong></label>
                <input type="text" class="form-control {{ ($errors->has('name')) ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Enter name here..." required>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <label for="email"><strong>Email</strong></label>
                <input type="email" class="form-control {{ ($errors->has('email')) ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter email here...">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <label for="race"><strong>Race</strong></label>
                <select id="race" class="form-control {{ ($errors->has('race')) ? 'is-invalid' : '' }}" name="race">
                  <option value="cn" {{ (old('race') == 'cn') ? 'selected' : ''}}>Chinese</option>
                  <option value="in" {{ (old('race') == 'in') ? 'selected' : ''}}>Indian</option>
                  <option value="my" {{ (old('race') == 'my') ? 'selected' : ''}}>Malay</option>
                  <option value="ot" {{ (old('race') == 'ot') ? 'selected' : ''}}>Other</option>
                </select>
                <input id="other" type="text" class="form-control" name="race" placeholder="Enter race here..." value="{{ old('race') }}" disabled style="display:none;">
                @if ($errors->has('race'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('race') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <label for="gender"><strong>Gender</strong></label>
                <div class="form-check">
                  <input type="radio" class="form-check-input" name="gender" value="M" {{ (old('gender') == 'M') ? 'checked' : ''}} checked>
                  <label class="form-check-label" for="gender"><strong>Male</strong></label>
                </div>
                <div class="form-check">
                  <input type="radio" class="form-check-input" name="gender" value="F" {{ (old('gender') == 'M') ? 'checked' : ''}}>
                  <label class="form-check-label" for="gender"><strong>Female</strong></label>
                </div>
              </div>
              <div class="form-group">
                <label for="address"><strong>Address 1</strong></label>
                <input type="text" class="form-control {{ ($errors->has('address')) ? 'is-invalid' : '' }}" name="address" placeholder="Enter address 1 here..." value="{{ old('address') }}">
                @if ($errors->has('address'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <label for="address2"><strong>Address 2</strong></label>
                <input type="text" class="form-control {{ ($errors->has('address2')) ? 'is-invalid' : '' }}" name="address2" placeholder="Enter address 2 here..." value="{{ old('address2') }}">
                @if ($errors->has('address2'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('address2') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="city"><strong>City</strong></label>
                  <input type="text" class="form-control {{ ($errors->has('city')) ? 'is-invalid' : '' }}" name="city" value="{{ old('city') }}">
                  @if ($errors->has('city'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('city') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group col-md-4">
                  <label for="state"><strong>State</strong></label>
                  <select id="state" name="state" class="form-control {{ ($errors->has('state')) ? 'is-invalid' : '' }}">
                    @foreach(config('settings.state.all') as $k => $v)
                        <option value="{{ $v }}" {{ (old('state') == $k) ? 'selected' : ''}}>{{ $v }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('state'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('state') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group col-md-2">
                  <label for="zip"><strong>Zip</strong></label>
                  <input type="text" class="form-control {{ ($errors->has('zip')) ? 'is-invalid' : '' }}" name="zip" value="{{ old('zip') }}">
                  @if ($errors->has('zip'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('zip') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="dob"><strong>Date Of Birth</strong></label>
                <input id="dob" type="date" class="form-control {{ ($errors->has('dob')) ? 'is-invalid' : '' }}" name="dob" min="1940-01-01" max="2030-12-31" value="{{ old('dob') }}" required>
                @if ($errors->has('dob'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('dob') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="card-footer">
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="is_check" checked>
                  <label for="license"><strong>Driving License</strong></label>
                </div>
                <select name="license" class="form-control license {{ ($errors->has('license')) ? 'is-invalid' : '' }}">
                  @foreach(config('settings.license.all') as $k)
                      <option value="{{ $k }}" {{ (old('license') == $k) ? 'selected' : ''}}>{{ $k }}</option>
                  @endforeach
                </select>
                @if ($errors->has('license'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('license') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <label for="expiry_date"><strong>Exipiry Date</strong></label>
                <input type="date" class="form-control license {{ ($errors->has('expiry_date')) ? 'is-invalid' : '' }}" name="expiry_date" min="1940-01-01" max="2030-12-31" value="{{ old('expiry_date') }}" required>
                @if ($errors->has('expiry_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('expiry_date') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" value="{{ $action }}" class="float-right btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
</div>

<script>
$(document).ready(function(){

  $('#race').on('change',function(){
    if($('#race option:selected').val() == 'ot'){
      $('#other').attr('disabled', false);
      $('#other').attr('required', true);
      $('#other').show();
    }
    else{
      $('#other').attr('disabled', true);
      $('#other').attr('required', false);
      $('#other').hide();
    }
  })

  $('#is_check').on('change',function(){
    if($('#is_check').is(':checked')){
      $('.license').attr('disabled', false);
    }
    else{
      $('.license').attr('disabled', true);
    }
  })

  $('form#registration').validate({
  rules: {
    email: {
      email: true,
    }
  },
  highlight: function (input) {
      $(input).addClass('is-invalid');
  },
  unhighlight: function (input) {
      $(input).removeClass('is-invalid');
  },
  errorClass: 'invalid-feedback font-weight-bold',
  errorElement: 'span',
  errorPlacement: function (error, element) {
      error.appendTo(element.parent('.form-group'));
  },

  });

})
</script>
@endsection
