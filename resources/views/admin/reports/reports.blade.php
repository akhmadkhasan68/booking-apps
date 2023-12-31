@extends('admin.admin')
@section('title')

@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-body">

            <h3 class="card-title">Report</h3>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="btn-primary">
                    <tr>
                        <th>Name</th>
                        <th>Nama Ruangan</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $index)
                        <tr>
                            <td>{{ $index->member->name }}</td>
                            <td>{{ $index->room->name }}</td>
                            <td>{{ $index->description }}</td>
                            <td>
                                <a href="{{ route('detailreport', $index->id) }}" class="btn btn-info">Detail</a>
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
