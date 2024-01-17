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
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>User</td>
                            <td>{{ $data->member->name }}</td>
                        </tr>
                        <tr>
                            <td>Nama Pemesan</td>
                            <td>{{ $data->name }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>{{ $data->member->nip }}</td>
                        </tr>
                        <tr>
                            <td>Divisi</td>
                            <td>{{ $data->member->division->name ?? '-' }}</td>
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
                            <td>Jumlah Partisipan Internal</td>
                            <td>{{ $data->participant_internal }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Partisipan External</td>
                            <td>{{ $data->participant_external }}</td>
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
                    @if($data->status === 'PENDING' || $data->status === 'DONE')
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <form action="{{ route('cancelbooking', $data->id) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger mt-3">Cancel Pemesanan</button>
                            </form>

                            @if($data->status === 'PENDING')
                                <!-- Tombol Approve hanya ditampilkan jika status PENDING -->
                                <form action="{{ route('approvebooking', $data->id) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success mt-3">Approve Pemesanan</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@show
