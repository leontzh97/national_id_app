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
       {{ session('errors') }}
    </div>
    @endif
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <h1>Change Password</h1>
        </div>
        <div class="card-body">
          <form id="changePassword" method="post" action="{{ route('passwords.update') }}">
            @csrf
            <div class="form-group">
             <label for="oldPassword">Old Password</label>
             <input type="password" class="form-control" id="oldPassword" name="old_password" required>
           </div>
           <div class="form-group">
            <label for="newPassword">New Password</label>
            <input type="password" class="form-control" id="newPassword" name="password" required>
          </div>
          <div class="form-group">
           <label for="confirmPassword">Retype New Password</label>
           <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" required>
         </div>
         <button type="submit" class="btn btn-primary mb-2" value="submit">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function () {
    $('form#changePassword').validate({
		rules: {
      password: {
	       required: true,
          minlength: 6,
      },
      password_confirmation: {
          equalTo: "#newPassword"
      }
		},
    highlight: function (input) {
        $(input).addClass('is-invalid');
    },
    unhighlight: function (input) {
        $(input).removeClass('is-invalid');
    },errorElement:'strong',
    errorPlacement: function (error,element) {
        error.addClass('invalid-feedback');
        error.insertAfter(element);
    },
    wrapper:'span'
  });
});
</script>
@endsection
