@extends('admin.admin')
@section('title')
    
@endsection
@section('content')
<div class="card card-primary">
<div class="card-body">

        <h3 class="card-title">Booking</h3>

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="btn-primary">
                <tr>
                    <th>name</th>
                    <th>NIP</th>
                    <th>Phone</th>
                    <th>Start date</th>
                    <th>end date</th>
                    <th>Participant</th>
                    <th>Description</th>
                    <th>room name</th>
                    <th>division</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $index)
                <tr>
                   
                    <td>{{ $index->users_name }}</td>
                    <td>{{ $index->admin->nip ?? $index->member->nip }}</td>
                    <td>{{ $index->phone }}</td>
                    <td>{{ $index->booking_start_date }}</</td>
                    <td>{{ $index->booking_end_date }}</</td>
                    <td>{{ $index->participant }}</</td>
                    <td>{{ $index->description }}</td>
                    <td>{{ $index->rooms_name }}</</td>
                    <td>{{ $index->division_name }}</</td>
                    {{-- <td>
                        <a href="#" class="btn btn-success">Accept</a>
                        <a href="#" class="btn btn-danger">Declined</a>
                    </td> --}}
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
</div>
@endsection
@show


