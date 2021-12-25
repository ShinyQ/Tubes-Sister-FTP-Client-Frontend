<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FileController extends Controller
{
    public function index(){
        $response = Http::get(env('RPC_URL'). 'file_list');
        $files =  $response->json()['data'];
        $title = 'User | List File';

        return view('file', compact('title', 'files'));
    }
}
