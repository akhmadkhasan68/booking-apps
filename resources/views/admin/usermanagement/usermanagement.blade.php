@extends('admin.admin')
@section('title')
    
@endsection
@section('content')
<div class="card card-primary">
<div class="card-body">

        <h3 class="card-title">User Management</h3>

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="btn-primary">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>gender</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>Address</th>
                    <th>division</th>
                    <th>roles</th>
                    <th>NIP</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $index)
                <tr>
                    <td>{{ $index->id }}</td>
                    <td>{{ $index->name }}</td>
                    <td>{{ $index->admin->gender ?? $index->member->gender }}</td>
                    <td>{{ $index->email }}</td>
                    <td>{{ $index->phone }}</td>
                    <td>{{ $index->admin->address ?? $index->member->address }}</td>
                    <td>{{ $index->division_name}}</td>
                    <td>{{ $index->roles }}</td>
                    <td>{{ $index->admin->nip ?? $index->member->nip }}</td>
                    <td>
                        <a href="{{ route('edituser', $index->id) }}" class="btn btn-warning">edit</a>
                        <form action="{{ route('deleteuser', $index->id) }}" method="get">
                            @csrf
                          <button type="submit" class="btn btn-danger mt-3">Delete</button>
                          </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection


