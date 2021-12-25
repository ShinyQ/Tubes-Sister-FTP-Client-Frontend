<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class FileController extends Controller
{
    public function index(Request $request){
        if (!$request->session()->exists('username')) {
            return redirect('/user/login');
        }

        $response = Http::get(env('RPC_URL'). 'file_list');
        $files =  $response->json()['data'];
        $title = 'User | List File';

        return view('file', compact('title', 'files'));
    }

    public function upload(Request $request){
        if (!$request->session()->exists('username')) {
            return redirect('/user/login');
        }

        if (!$request->file('file')) {
            return redirect()->back()->with('error', 'Belum Ada File Yang Dilampirkan');
        }

        $validator = Validator::make($request->all(), [
            'file' => 'max:2048',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error', 'Ukuran File Tidak Boleh Melebihi 2 MB');
        }

        $file = $request->file('file');
        $response = Http::attach('file', file_get_contents($file), $file->getClientOriginalName())
            ->post(env('RPC_URL'). 'upload_file', [
                'id' => $request->session()->get('id')
            ]);

        if(!$response->ok()) {
            return redirect()->back()->with('error', 'Terdapat Masalah Pada Server');
        }

        return redirect()->back()->with('success', 'Sukses Melakukan Upload File');
    }

    public function download(Request $request, $id){
        if (!$request->session()->exists('username')) {
            return redirect('/user/login');
        }

        $response = Http::post(env('RPC_URL'). 'download_file', [
            'id' => $request->session()->get('id'),
            'uuid_file' => $id
        ]);

        if (!$response->ok()){
            return redirect()->back()->with('error', 'Terdapat Masalah Pada Server');
        }

        $link = 'http://localhost:8000/files/'. $response->json()['data'];

        return response()->streamDownload(function () use ($link) {
            echo file_get_contents($link);
        }, $response->json()['data']);
    }
}
