@extends('template.layout')
@section('content')
<head>
    <!-- Load plotly.js into the DOM -->
    <script src='https://cdn.plot.ly/plotly-2.8.3.min.js'></script>
</head>
<div id='myDiv'><!-- Plotly chart will be drawn inside this DIV --></div>

<div class="row  mt-5">
    <div class="col-sm-12 col-md-6">
        <h5 class="mb-3"><strong>Peringkat Upload Terbanyak</strong></h5>
        <table class="table">

            <thead style="background-color: #4e73df; color: white">
            <tr>
                <th scope="col">Urutan</th>
                <th scope="col">Username</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody style="background-color: white">
            @foreach($most_upload as $i => $mp)
            <tr>
                <th scope="row">{{ $i + 1 }}</th>
                <td>{{ $mp['username'] }}</td>
                <td>{{ $mp['total'] }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-sm-12 col-md-6">
        <h5 class="mb-3"><strong>Peringkat Download Terbanyak</strong></h5>
        <table class="table">

            <thead style="background-color: #4e73df; color: white">
            <tr>
                <th scope="col">Urutan</th>
                <th scope="col">Username</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody style="background-color: white">
            @foreach($most_download as $i => $md)
                <tr>
                    <th scope="row">{{ $i + 1 }}</th>
                    <td>{{ $md['username'] }}</td>
                    <td>{{ $md['total'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
    const trace0 = {
        x: @json($log_all_date),
        y: @json($log_all),
        type: 'line',
        name: 'Total Aktivitas'
    };

    const trace1 = {
        x: @json($log_upload_date),
        y: @json($log_upload),
        type: 'line',
        name: 'Jumlah Upload'
    };

    const trace2 = {
        x: @json($log_download_date),
        y: @json($log_download),
        type: 'line',
        name: 'Jumlah Download'
    };

    const data = [trace0, trace1, trace2];
    const layout = {
        title: 'Grafik Keseluruhan Download Dan Upload Harian',
        xaxis: {
            title: 'Tanggal'
        },
        yaxis: {
            title: 'Jumlah'
        }
    };

    Plotly.newPlot('myDiv', data, layout);

</script>
@endsection