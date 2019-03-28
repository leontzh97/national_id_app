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
        <form id="update" method="post" action="{{ route('nric.update') }}" onsubmit="return validateLogin()">
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

  $('form#update').validate({
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
          return data.nric;
        }
      },
      templateSelection : function(data)
      {
        if(data.nric){
          return data.nric;
        }
      },
      escapeMarkup : function(markup){ return markup; }
  });

  var CitizenContract = web3.eth.contract(
    {!! config('settings.contract.abi') !!}
  );
  var Citizen = CitizenContract.at('{{ config('settings.contract.block') }}');


  $('#nric').on('change',function(){
    let data = $('#nric').select2('data');
    Citizen.getDOB(web3.fromAscii(data[0].nric),function(error,result){
      if(error){
        console.error(error);
      }
      else {
        var dob = new Date(web3.toUtf8(result));
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
        $('#dob').val(date);
      }}
    );

    Citizen.getName(web3.fromAscii(data[0].nric),function(error,result){
      if(error){
        console.error(error);
      }
      else {
        var name = web3.toUtf8(result);
        $('#name').val(name);
      }}
    );

    Citizen.getEmail(web3.fromAscii(data[0].nric),function(error,result){
      if(error){
        console.error(error);
      }
      else {
        var email = web3.toUtf8(result);
        $('#email').val(email);
      }}
    );

    Citizen.getAddress1(web3.fromAscii(data[0].nric),function(error,result){
      if(error){
        console.error(error);
      }
      else {
        var address_1 = web3.toUtf8(result);
        $('#address').val(address_1);
      }}
    );

    Citizen.getAddress2(web3.fromAscii(data[0].nric),function(error,result){
      if(error){
        console.error(error);
      }
      else {
        var address_2 = web3.toUtf8(result);
        $('#address2').val(address_2);
      }}
    );

    Citizen.getCity(web3.fromAscii(data[0].nric),function(error,result){
      if(error){
        console.error(error);
      }
      else {
        var city = web3.toUtf8(result);
        $('#city').val(city);
      }}
    );

    Citizen.getState(web3.fromAscii(data[0].nric),function(error,result){
      if(error){
        console.error(error);
      }
      else {
        var state = web3.toUtf8(result);
        $('#state').val(state).trigger('change');
      }}
    );

    Citizen.getZIP(web3.fromAscii(data[0].nric),function(error,result){
      if(error){
        console.error(error);
      }
      else {
        var zip = web3.toUtf8(result);
        $('#zip').val(zip);
      }}
    );

    Citizen.getDrivingLicense(web3.fromAscii(data[0].nric),function(error,result){
      if(error){
        console.error(error);
      }
      else {
        console.log(web3.toUtf8(result));
        var driving_license = web3.toUtf8(result);
        if(driving_license == 'null'){
          console.log('not licensed');
          $('#is_check').attr('checked',false).trigger('change');
        }
        else {
          console.log('licensed');
          $('#is_check').attr('checked',true).trigger('change');
          $('#driving').val(driving_license).trigger('change');
          Citizen.getDriverExpiryDate(web3.fromAscii(data[0].nric),function(error,result){
            if(error){
              console.error(error);
            }
            else {
              let expiry = new Date(web3.toUtf8(result));
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
            }}
          );
        }
      }}
    );

    Citizen.getGender(web3.fromAscii(data[0].nric),function(error,result){
      if(error){
        console.error(error);
      }
      else {
        var gender = web3.toUtf8(result);
        if(gender == 'M'){
          $('#male').attr('checked', true);
        }
        else {
          $('#female').attr('checked', true);
        }
      }}
    );

    Citizen.getRace(web3.fromAscii(data[0].nric),function(error,result){
      if(error){
        console.error(error);
      }
      else {
        var race = web3.toUtf8(result);
        if(race == 'my' || race == 'cn' || race == 'in'){
          $('#race').trigger('change');
          $('#race').val(race);
        }
        else{
          $('#race').val('ot');
          $('#race').trigger('change');
          $('#other').val(race);
        }
      }}
    );

  });
});

function validateLogin()
{
  if(web3.eth.defaultAccount == null){
    alert('Please login to your metamask.');
    window.web3 = new Web3(ethereum);
    ethereum.enable();
    return false;
  }
  return true;
};
</script>
@endsection
