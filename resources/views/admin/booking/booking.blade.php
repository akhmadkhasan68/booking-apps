@extends('admin.admin')
@section('title')

@endsection
@section('content')
<div class="card card-primary">
    <div class="card-body">

        <h3 class="card-title">Booking</h3>

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="btn-primary">
                <tr>
                    <th>User</th>
                    <th>Nama</th>
                    <th>Ruangan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $index)
                <tr>

                    <td>{{ $index->member->name }}</td>
                    <td>{{ $index->name }}</td>
                    <td>{{ $index->room->name }}</</td>
                    <td>{{ $index->booking_start_date }}</</td>
                    <td>{{ $index->booking_end_date }}</</td>
                    <td>{{ $index->status }}</td>
                    <td>
                        <a href="{{ route('detailbooking', $index->id) }}" class="btn btn-info">Detail</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        {{ $datas->links() }}

    </div>
</div>
@endsection
@show
