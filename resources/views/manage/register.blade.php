@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <h1>{{ $action }} Citizen</h1>
      </div>
      <div class="col-md-12">
        <form id="registration" method="post" action="">
          <div class="card">
            <div class="card-body bg-light">
              <div class="form-group">
                <label for="name"><strong>Name</strong></label>
                <input type="text" class="form-control" name="name" placeholder="Enter name here..." required>
              </div>
              <div class="form-group">
                <label for="email"><strong>Email</strong></label>
                <input type="email" class="form-control" name="email" placeholder="Enter email here...">
              </div>
              <div class="form-group">
                <label for="race"><strong>Race</strong></label>
                <select id="race" class="form-control" name="race">
                  <option value="cn">Chinese</option>
                  <option value="in">Indian</option>
                  <option value="my">Malay</option>
                  <option value="ot">Other</option>
                </select>
                <input id="other" type="text" class="form-control" name="race" placeholder="Enter race here..." disabled style="display:none;">
              </div>
              <div class="form-group">
                <label for="gender"><strong>Gender</strong></label>
                <div class="form-check">
                  <input type="radio" class="form-check-input" name="gender" value="M">
                  <label class="form-check-label" for="gender"><strong>Male</strong></label>
                </div>
                <div class="form-check">
                  <input type="radio" class="form-check-input" name="gender" value="F">
                  <label class="form-check-label" for="gender"><strong>Female</strong></label>
                </div>
              </div>
              <div class="form-group">
                <label for="address"><strong>Address 1</strong></label>
                <input type="text" class="form-control" name="address" placeholder="Enter address 1 here...">
              </div>
              <div class="form-group">
                <label for="address2"><strong>Address 2</strong></label>
                <input type="text" class="form-control" name="address2" placeholder="Enter address 2 here...">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="city"><strong>City</strong></label>
                  <input type="text" class="form-control" name="city">
                </div>
                <div class="form-group col-md-4">
                  <label for="state"><strong>State</strong></label>
                  <select name="state" class="form-control">
                    @foreach(config('settings.state.all') as $k => $v)
                        <option value="{{ $k }}" @if($field['state'] == $k) selected @endif>{{ $v }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="zip"><strong>Zip</strong></label>
                  <input type="text" class="form-control" name="zip">
                </div>
              </div>
              <div class="form-group">
                <label for="dob"><strong>Date Of Birth</strong></label>
                <input type="date" class="form-control" name="dob" min="1940-01-01" max="2030-12-31" required>
              </div>
              <label for="nric"><strong>NRIC</strong></label>
              <div class="form-row">
                <div class="form-group col-md-10">
                  <input type="text" class="form-control" name="nric" placeholder="Generate NRIC here..." value="123" readonly required>
                </div>
                <div class="form-group col-md-2">
                  <button class="form-control btn btn-success">Generate</button>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="is_check" checked>
                  <label for="license"><strong>Driving License</strong></label>
                </div>
                <select name="license" class="form-control license">
                  @foreach(config('settings.license.all') as $k)
                      <option value="{{ $k }}" @if($field['license'] == $k) selected @endif>{{ $k }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="expiry_date"><strong>Exipiry Date</strong></label>
                <input type="date" class="form-control license" name="expiry_date" min="1940-01-01" max="2030-12-31" required>
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
      $('#other').show();
    }
    else{
      $('#other').attr('disabled', true);
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
