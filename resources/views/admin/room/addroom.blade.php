@extends('admin.admin')
@section('title')
    
@endsection
@section('content')
<div class="card mb-3 p-5">
    <div>
        <a href="{{ URL::to('admin/room') }}" class="btn btn-danger mb-5"> back</a>
    </div>
   <div>
    <h5>Add Image</h5>
    <input type="file">
    <div class="mt-3">
        <h5 class=""> Room Name</h5>
        <input type="text" class="form-control" placeholder="Room Name">
    </div>
    <div class="mt-3">
        <h5>Floor</h5>
        <select class="formcontrol"> 
            <option selected>opongono</option>
            <option value="#">opokih?</option>
        </select>
    </div>
    <div class="mt-3">
        <h5 class=""> Facility</h5>
        <div class="row g-0 position-relative">
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="Facility">
            </div>
            <div class="col-md-4">
                <button class="btn btn-success" >Add Facility</button>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <h5>Added Facility</h5>
    </div>
   </div>
</div>
<div class="w-100 text-center">
    <button class="btn btn-primary mt-5" >Save</button>
  </div>
@endsection
@show