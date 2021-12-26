<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class StatisticController extends Controller
{
    public function statistic(){
        $response = Http::get(env('RPC_URL'). 'logs_upload');

        $log_upload = [];
        $log_upload_date = [];
        foreach ($response->json()['data'] as $data){
            array_push($log_upload,  $data['total']);
            array_push($log_upload_date,  $data['tanggal']);
        }

        $response = Http::get(env('RPC_URL'). 'logs_download');

        $log_download = [];
        $log_download_date = [];
        foreach ($response->json()['data'] as $data){
            array_push($log_download,  $data['total']);
            array_push($log_download_date,  $data['tanggal']);
        }

        $response = Http::get(env('RPC_URL'). 'logs_all');

        $log_all = [];
        $log_all_date = [];
        foreach ($response->json()['data'] as $data){
            array_push($log_all,  $data['total']);
            array_push($log_all_date,  $data['tanggal']);
        }

        $most_upload = Http::get(env('RPC_URL'). 'most_active_upload')->json()['data'];
        $most_download = Http::get(env('RPC_URL'). 'most_active_download')->json()['data'];

        $title = 'User | Statistic';

        return view('statistic',
            compact(
                'title', 'log_upload', 'log_upload_date', 'log_download',
                'log_download_date', 'log_all', 'log_all_date', 'most_upload', 'most_download'
            ));
    }

    public function log(){
        $title = 'User | FTP Server Log';
        $logs = Http::get(env('RPC_URL'). 'logs_data')->json()['data'];
        return view('log', compact('title', 'logs'));
    }
}
