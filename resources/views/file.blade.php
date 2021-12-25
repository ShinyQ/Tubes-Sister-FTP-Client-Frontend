@extends('template.layout')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-black"><b>List File Pada FTP Server</b></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List File</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="text-align: center">
                    <tr>
                        <th>No</th>
                        <th>Nama File</th>
                        <th>Uploader</th>
                        <th>Ukuran File</th>
                        <th>Tanggal Diupload</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center">
                    @foreach($files as $i => $file)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $file['fileName'] }}</td>
                        <td>{{ $file['username'] }}</td>
                        <td>{{ round($file['size'] / 1024, 2) }} kB</td>
                        <td>{{ $file['createdAt'] }}</td>
                        <td>
                            <div style="text-align: center;">
                                <a href="#" class="btn btn-success btn-icon-split">
                                    <span class="text">Download</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop