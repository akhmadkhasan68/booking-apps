@extends('admin.admin')
@section('title')
    
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('report') }}" class="btn btn-danger mb-5">Back</a>
            <div class="card">
                <div class="card-header">
                    Detail Pengaduan
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Nama</td>
                            <td>{{ $data->member->name }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>{{ $data->member->nip }}</td>
                        </tr>
                        <tr>
                            <td>Divisi</td>
                            <td>{{ $data->member->division->name }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Telepon</td>
                            <td>{{ $data->member->user->phone }}</td>
                        </tr>
                        <tr>
                            <td>Nama Ruangan</td>
                            <td>{{ $data->room->name }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>{{ $data->description }}</td>
                        </tr>
                        <tr>
                            <td>Foto</td>
                            <td>
                                @foreach($data->medias as $media)
                                    <img src="{{ $media->attachment }}" alt="" width="100px" height="100px">
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@show
