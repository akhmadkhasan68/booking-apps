@extends('admin.admin')
@section('title')
    
@endsection
@section('content')
<div class="card card-primary">
<div class="card-body">

        <h3 class="card-title">Report</h3>

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="btn-primary">
                <tr>
                    <th>Name</th>
                    <th>room name</th>
                    <th>description</th>
                    <th>media</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($datas as $index)
                    <td>{{ $index->name }}</td>
                    <td>{{ $index->room_name }}</td>
                    <td>{{ $index->description }}</td>
                    <td>{{ $index->attachment }}</td>
                    <td>
                        <a href="#" class="btn btn-primary">detail</a>
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection
@show


