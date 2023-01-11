@extends('admin.admin')
@section('title')
    
@endsection
@section('content')
<div class="card mb-3 p-5">

    <h3 class="card-title">Room</h3>  
    <div class="row g-0 position-relative">
      @foreach ($datas as $room)
          
      <div class="col-md-4">
        <img src="{{ $room->image }}" class="img-fluid rounded-start" alt="Gambar" >
      </div>
      <div class="col-md-4">
        <div class="card-body">
          <h5 class="card-title">{{$room->name}}</h5>
          <p class="card-text">{{$room->capacity}}</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
      </div>
      <div class="col-md-4 position-absolute" style="bottom: 20px; right:0px">
        <a href="{{ URL::to('admin/room/editfacility') }}" class="btn btn-warning">Edit Facility</a>
      </div>
      @endforeach
    </div>
    
  </div>
  <div class="w-100 text-center">
    <a class="btn btn-primary mt-5" href="{{ route('addroom') }}">Add Room</a>
  </div>
@endsection
@show