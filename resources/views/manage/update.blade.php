@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
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
        <form id="registration" method="post" action="{{ route('nric.update') }}">
          @csrf
          <div class="card">
            <div class="card-body bg-light">
              <div class="form-group">
                <label for="nric"><strong>NRIC</strong></label>
                <select id="nric" name="nric" class="form-control" style="width:100%"></select>
              </div>
              <div class="form-group">
                <label for="name"><strong>Name</strong></label>
                <input id="name" type="text" class="form-control" name="name" readonly>
              </div>
              <div class="form-group">
                <label for="email"><strong>Email</strong></label>
                <input id="email" type="email" class="form-control {{ ($errors->has('email')) ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter email here...">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <label for="race"><strong>Race</strong></label>
                <select id="race" class="form-control" name="race" readonly>
                  <option value="cn" {{ (old('race') == 'cn') ? 'selected' : ''}}>Chinese</option>
                  <option value="in" {{ (old('race') == 'in') ? 'selected' : ''}}>Indian</option>
                  <option value="my" {{ (old('race') == 'my') ? 'selected' : ''}}>Malay</option>
                  <option value="ot" {{ (old('race') == 'ot') ? 'selected' : ''}}>Other</option>
                </select>
                <input id="other" type="text" class="form-control" name="race" disabled readonly style="display:none;">
              </div>
              <div class="form-group">
                <label for="gender"><strong>Gender</strong></label>
                <div class="form-check">
                  <input id="male" type="radio" class="form-check-input" name="gender" value="M" readonly>
                  <label class="form-check-label" for="gender"><strong>Male</strong></label>
                </div>
                <div class="form-check">
                  <input id="female" type="radio" class="form-check-input" name="gender" value="F" readonly>
                  <label class="form-check-label" for="gender"><strong>Female</strong></label>
                </div>
              </div>
              <div class="form-group">
                <label for="address"><strong>Address 1</strong></label>
                <input id="address" type="text" class="form-control {{ ($errors->has('address')) ? 'is-invalid' : '' }}" name="address" value="{{ old('address') }}">
                @if ($errors->has('address'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <label for="address2"><strong>Address 2</strong></label>
                <input id="address2" type="text" class="form-control {{ ($errors->has('address2')) ? 'is-invalid' : '' }}" name="address2" value="{{ old('address2') }}">
                @if ($errors->has('address2'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('address2') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="city"><strong>City</strong></label>
                  <input id="city" type="text" class="form-control {{ ($errors->has('city')) ? 'is-invalid' : '' }}" name="city" value="{{ old('city') }}">
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
                  <input id="zip" type="text" class="form-control {{ ($errors->has('zip')) ? 'is-invalid' : '' }}" name="zip" value="{{ old('zip') }}">
                  @if ($errors->has('zip'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('zip') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="dob"><strong>Date Of Birth</strong></label>
                <input id="dob" type="date" class="form-control {{ ($errors->has('dob')) ? 'is-invalid' : '' }}" name="dob" min="1940-01-01" max="2030-12-31" readonly>
              </div>
            </div>
            <div class="card-footer">
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="is_check" checked>
                  <label for="license"><strong>Driving License</strong></label>
                </div>
                <select id="driving" name="license" class="form-control license {{ ($errors->has('license')) ? 'is-invalid' : '' }}">
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
                <input id="expiry_date" type="date" class="form-control license {{ ($errors->has('expiry_date')) ? 'is-invalid' : '' }}" name="expiry_date" min="1940-01-01" max="2030-12-31" value="{{ old('expiry_date') }}" required>
                @if ($errors->has('expiry_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('expiry_date') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" value="{{ $action }}" class="float-right btn btn-success">Update</button>
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

  $('#nric').select2({
      ajax : {
          url : "{{ route('nric.load-citizen') }}",
          dataType : 'json',
          type: "POST",
          delay : 200,
          data : function(params){
              return {
                  q : params.term,
                  page : params.page,
                  _token: $('meta[name="csrf-token"]').attr('content')
              };
          },
          processResults : function(data, params){
              params.page = params.page || 1;
              return {
                  results : data.data,
                  pagination: {
                      more : (params.page  * 10) < data.total
                  }
              };
          }
      },
      templateResult : function (data)
      {
        if(data.nric){
          return data.nric + ' :: ' + data.name;
        }
      },
      templateSelection : function(data)
      {
        if(data.nric){
          return data.nric + ' :: ' + data.name;
        }
      },
      escapeMarkup : function(markup){ return markup; }
  });

  $('#nric').on('change',function(){
    let data = $('#nric').select2('data');

    let dob = new Date(data[0].date_of_birth);
    var m = dob.getMonth() + 1;
    var d = dob.getDate();
    var y = dob.getFullYear();
    if(m < 10){
      m = '0'+m;
    }
    if(d < 10){
      d = '0'+d;
    }
    var date = y + '-' + m + '-' + d;

    $('#name').val(data[0].name);
    $('#email').val(data[0].email);
    $('#address').val(data[0].address_1);
    $('#address2').val(data[0].address_2);
    $('#city').val(data[0].city);
    $('#state').val(data[0].state).trigger('change');
    $('#zip').val(data[0].zip);
    $('#dob').val(date);
    if(data[0].driving_license){
      $('#is_check').attr('checked',true).trigger('change');
      $('#driving').val(data[0].driving_license).trigger('change');
      let expiry = new Date(data[0].driver_expiry_date);
      var mm = expiry.getMonth() + 1;
      var dd = expiry.getDate();
      var yy = expiry.getFullYear();
      if(mm < 10){
        mm = '0'+mm;
      }
      if(dd < 10){
        dd = '0'+dd;
      }
      var dt = yy + '-' + mm + '-' + dd;
      $('#expiry_date').val(dt);
    }
    else {
      $('#is_check').attr('checked',false).trigger('change');
    }
    if(data[0].gender == 'M'){
      $('#male').attr('checked', true);
    }
    else {
      $('#female').attr('checked', true);
    }
    if(data[0].race == 'my' || data[0].race == 'cn' || data[0].race == 'in'){
      $('#race').trigger('change');
      $('#race').val(data[0].race);
    }
    else{
      $('#race').val('ot');
      $('#race').trigger('change');
      $('#other').val(data[0].race);
    }

  });
})
</script>
@endsection
