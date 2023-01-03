@extends('admin.admin')
@section('title')
    
@endsection
@section('content')
<div class="card mb-3 p-5">
  <div>
    <a href="{{ URL::to('admin/room') }}" class="btn btn-danger"> back</a>
  </div>
  <div>
    <h1>Ini ruangan</h1>
  </div>
    <div class="row g-0 position-relative">
      <div class="col-md-4">
        <img src="{{ asset('img/krte.jpg') }}" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-4">
        <div class="card-body">
          <h5 class="card-title">Facility</h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          <a href="#" class="btn btn-warning">Edit Facility</a>
        </div>
      </div>
    </div>
    <div class="mt-3">
      <h5 class=""> Facility</h5>
      <div class="row g-0">
          <div class="col-md-8">
              <input type="text" class="form-control" placeholder="Facility">
          </div>
          <div class="col-md-4">
              <button class="btn btn-success" >Add Facility</button>
          </div>
      </div>
  </div>
  </div>
  <div class="w-100 text-center">
    <a class="btn btn-primary mt-5" href="{{ URL::to('admin/room/addroom') }}">Save</a>
  </div>
@endsection
@show