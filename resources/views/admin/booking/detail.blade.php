@extends('admin.admin')
@section('title')
    
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('booking') }}" class="btn btn-danger mb-5">Back</a>
            <div class="card">
                <div class="card-header">
                    Detail Booking
                </div>

                <div class="card-body">
                    @if($data->status === 'PENDING')
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('cancelbooking', $data->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-warning mt-3">Cancel</button>
                            </form>
                            <a href="{{ route('approvebooking', $data->id) }}" class="btn btn-success mt-3">Approve</a>
                        </div>
                    </div>
                    <br>
                    @endif
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
                            <td>Tipe Peserta</td>
                            <td>{{ $data->participant_type }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td>{{ $data->booking_start_date }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>{{ $data->booking_end_date }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Partisipan</td>
                            <td>{{ $data->participant }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>{{ $data->description }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ $data->status }}</td>
                        </tr>
                        <tr>
                            <td>Attachment</td>
                            <td>
                                @if($data->attachment)
                                    <a href="{{ $data->attachment }}" target="__blank">Lihat Attachment</a>
                                @else
                                    -
                                @endif
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
