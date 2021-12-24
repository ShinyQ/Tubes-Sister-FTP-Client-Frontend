@extends('template.layout')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-black"><b>Upload File FTP</b></h1>
    <form action="">
        <input class="mt-4" type="file" name="file">
        <a href="#" class="btn btn-primary btn-icon-split">
            <span class="text">Upload File</span>
        </a>
    </form>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List File Anda</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="text-align: center">
                    <tr>
                        <th>No</th>
                        <th>Nama File</th>
                        <th>Ukuran File</th>
                        <th>Tanggal Diupload</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center">
                    <tr>
                        <td>1</td>
                        <td>System Architect.pdf</td>
                        <td>{{ round(2000 / 1024, 2) }} kB</td>
                        <td>2020-01-01</td>
                        <td>
                            <div style="text-align: center;">
                                <a href="#" class="btn btn-success btn-icon-split">
                                    <span class="text">Download</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop