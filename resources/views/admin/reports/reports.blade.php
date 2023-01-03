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
                    <th>id</th>
                    <th>member_id</th>
                    <th>room_id</th>
                    <th>Feedback_id</th>
                    <th>Description</th>
                    <th>Attachment</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                    <td>$320,800</td>
                    <td>
                        <a href="#" class="btn btn-primary">detail</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection
@show


