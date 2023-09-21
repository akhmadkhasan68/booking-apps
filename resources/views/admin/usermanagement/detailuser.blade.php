@extends('admin.admin')
@section('title')
    
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('usermanagement') }}" class="btn btn-danger mb-5">Back</a>
            <div class="card">
                <div class="card-header">
                    Detail Profile
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Nama</td>
                            <td>{{ $data->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $data->email }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Telepon</td>
                            <td>{{ $data->phone }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>{{ $data->member->nip }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>{{ $data->member->gender }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ $data->member->address }}</td>
                        </tr>
                        <tr>
                            <td>Divisi</td>
                            <td>{{ $data->member->division->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@show
