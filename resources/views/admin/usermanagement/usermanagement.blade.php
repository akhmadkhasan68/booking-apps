@extends('admin.admin')
@section('title')

@endsection
@section('content')
<div class="card card-primary">
<div class="card-body">

    <h3 class="card-title">User Management</h3>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="btn-primary">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Handphone</th>
                <th>NIP</th>
                <th>Aksi</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $data)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->phone }}</td>
                <td>{{ $data->admin->nip ?? $data->member->nip }}</td>
                <td>
                    <a href="{{ route('edituser', $data->id) }}" class="btn btn-warning">edit</a>
                    <a href="{{ route('detailuser', $data->id) }}" class="btn btn-info">detail</a>
                    <form action="{{ route('deleteuser', $data->id) }}" method="get">
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
<div class="w-100 text-center">
    <a class="btn btn-primary mt-5" href="{{ route('adduser') }}">Tambah User</a>
  </div>
@endsection
