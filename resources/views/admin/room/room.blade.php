@extends('admin.admin')
@section('title')
    
@endsection
@section('content')
<div class="card mb-3 p-5">
    
    <h3 class="card-title">Room</h3>
    <div class="row g-0 position-relative">
      <div class="col-md-4">
        <img src="{{ asset('img/krte.jpg') }}" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-4">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
      </div>
      <div class="col-md-4 position-absolute" style="bottom: 20px; right:0px">
        <a href="{{ URL::to('admin/room/editfacility') }}" class="btn btn-warning">Edit Facility</a>
      </div>
    </div>
  </div>
  <div class="w-100 text-center">
    <a class="btn btn-primary mt-5" href="{{ URL::to('admin/room/addroom') }}">Add Room</a>
  </div>
@endsection
@show