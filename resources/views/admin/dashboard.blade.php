@extends('admin.admin')
@section('title')
    
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Frequently used room</h6>
    </div>
    <div class="card-body">
        <div style="width: 100%;"><canvas id="frequentlyRoomBooked"></canvas></div>
    </div>
</div>
@endsection

@section('js')
<script>
    const frequentlyRoomBooked = {{ Js::from($topFiveFrequentlyRoomBooked) }};
    
    const frequentlyRoomBookedChart = new Chart(
        document.getElementById('frequentlyRoomBooked'),
        {
            type: 'bar',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: {
                labels: frequentlyRoomBooked.map(row => row.name),
                datasets: [
                    {
                        label: 'Top 5 Ruangan yang Sering Digunakan',
                        data: frequentlyRoomBooked.map(row => row.total)
                    }
                ]
            }
        }
    );
</script>
@endsection
