@extends('template.layout')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-black"><b>Log Aktivitas Server FTP</b></h1>

    @if (\Session::has('error'))
        <div class="mt-4 alert alert-danger">
            <div style="text-align: center;">{!! \Session::get('error') !!}</div>
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-5">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="text-align: center">
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Nama File</th>
                        <th>Jenis Aksi</th>
                        <th>Tanggal Aksi</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center">
                    @foreach($logs as $i => $log)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $log['username'] }}</td>
                            <td>{{ $log['filename'] }}</td>
                            <td>{{ $log['action'] }}</td>
                            <td>{{ $log['tanggal'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop