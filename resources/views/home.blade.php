@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <h1 class="text-center">Welcome to MyGovernment</h1>
        </div>
        <div class="col-md-8" id="logo" style="height:360;width:360;">
          <img src="{{ asset('images/WP_logo.png') }}" class="mx-auto d-block" alt="myGovernment"><br><br>
        </div>
        <div class="col-md-8">
        <div class="table-responsive">
        <table id="citizensTable" class="table table-hover text-center" style="width:100%">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Email Address</th>
              <th scope="col">NRIC</th>
            </tr>
          </thead>
          <tbody style="background-color:white;"></tbody>
        </table>
      </div>
      </div><!--table end-->
    </div>
</div>

<script>
$(document).ready(function() {

    var dataTable = $('#citizensTable').DataTable({
        'processing': true,
        'serverSide': true,
        'order': [0, 'desc'],
        "ajax":{
            "url" : "{{ route('nric.listing') }}",
            "dataType": "json",
            "type": "POST",
            "data":{
                '_token': $('meta[name="csrf-token"]').attr('content')
            }
        },
        'columns': [
            { 'data': 'id', 'name': 'id' },
            { 'data': 'name', 'name': 'name' },
            { 'data': 'email', 'name': 'email' },
            { 'data': 'nric', 'name': 'nric' },
        ]
    });

});
</script>
@endsection
