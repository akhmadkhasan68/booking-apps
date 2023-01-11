@extends('admin.admin')
@section('title')
    
@endsection
@section('content')
<div class="card mb-3 p-5">
    <div>
        <a href="{{ route('room') }}" class="btn btn-danger mb-5">Back</a>
    </div>
    <form action="{{ route('save') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div>
            <h5>Add Image</h5>
            <input type="file" id="image" name="image">
        </div>

         <div class="mt-3">
            <h5 class=""> Room Name</h5>
            <input type="text" class="form-control" placeholder="Room Name" id="name" name="name">
        </div>
        <div class="mt-3">
            <h5>Floor</h5>
            <select class="form-control" id="floor" name="floor"> 
                <option selected>------ Silahkan Pilih Lantai ------</option>
                <option value="1">Lantai 1</option>
                <option value="2">Lantai 2</option>
                <option value="3">Lantai 3</option>
                <option value="4">Lantai 4</option>
            </select>


        </div>

        <div class="mt-3">
            <h5 class="">Capacity</h5>
            <div class="row g-0 position-relative">
                <div class="col-md-8">
                    <input type="number" class="form-control" placeholder="Capacity" id="capacity" name="capacity">
                </div>
        </div>
        <div class="mt-3">
            <h5 class="">Facility</h5>
            <div class="row g-0 position-relative">
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Facility" id="facility" name="facility">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-success" >Add Facility</button>
                </div>
        </div>
        <div class="mt-3">
            <h5>Added Facility</h5>
        </div>
    </form>
    <div class="w-100 text-center">
        <button class="btn btn-primary mt-5" type="submit" value="save">Save</button>
    </div>
</div>

@endsection
@show