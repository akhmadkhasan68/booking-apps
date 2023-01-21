@extends('admin.admin')
@section('title')
    
@endsection
@section('content')
<div class="card mb-3 p-5">

    <h2 class="card-title">Room</h2>  
    <div class="container">
      <div class="d-flex col-md-12">
        <div class="card-body justify-content-center">
          <table class="w-100 m-auto card p-3" style="box-shadow: 3px 3px 5px #aaaaaa;">
            @foreach ($datas as $row)
            <tr class="">
              <td class="text-center col-6 p-2">
                <img src="{{ $row->image }}" class="rounded" alt="Gambar" style="width: 200px; height:200px;"></td>
              <td class="col-4 pt-3">
                <ul>
                  <li>Nama : {{ $row->name }}</li>
                  <li>Lantai : {{ $row->floor }}</li>
                  <li>Kapasitas : {{ $row->capacity }} Orang</li>
                  @foreach ($row->room_facilities as $item)
                      
                  <li>Fasilitas : {{ $item->facility->name}} : {{ $item->quantity }}</li>

                  @endforeach
                </ul>
              </td>
              <td class="col-2">
                <div class="mb-2">
                  <a href="{{ route('editfacility', $row->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('deleteroom', $row->id) }}" method="get">
                      @csrf
                    <button type="submit" class="btn btn-danger mt-3">Delete Room</button>
                    </form>
                    
                </div>
              </td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
    <div class="w-100 text-center">
      <a class="btn btn-primary mt-5" href="{{ route('addroom') }}">Add Room</a>
    </div>
  </div>
@endsection
@show
