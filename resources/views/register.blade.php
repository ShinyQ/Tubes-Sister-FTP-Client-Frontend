@extends('template.layout')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-black"><b>List Pengguna</b></h1>

    @if (\Session::has('error'))
        <div class="mt-4 alert alert-danger">
            <div style="text-align: center;">{!! \Session::get('error') !!}</div>
        </div>
    @endif

    @if (\Session::has('success'))
        <div class="mt-4 alert alert-success">
            <div style="text-align: center;">{!! \Session::get('success') !!}</div>
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4 mt-3">
                <div class="card-body">
                    <h5 class="mb-3"><b>Tambah Pengguna</b></h5>
                    <form action="/user/register" method="POST">
                        @csrf
                        <input class="form-control mb-3" type="text" name="username" placeholder="Masukkan Username">
                        <input class="form-control mb-3" type="text" name="password" placeholder="Masukkan Password">
                        <div style="float:right">
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4 mt-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead style="text-align: center">
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            @foreach($users as $i => $user)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $user['username'] }}</td>
                                    <td>{{ $user['role'] }}</td>
                                    <td>{{ $user['created_at'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop