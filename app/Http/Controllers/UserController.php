<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(Request $request){
        if (!$request->session()->exists('username')) {
            return redirect('/user/login');
        }

        $response = Http::post(env('RPC_URL'). 'user_file_list', [
            'id' => $request->session()->get('id')
        ]);

        $files =  $response->json()['data'];
        $title = 'User | Homepage';

        return view('index', compact('title', 'files'));
    }

    public function register(Request $request){
        $response = Http::post( env('RPC_URL'). 'register', [
            'username' => $request->username,
            'password' => $request->password
        ]);

        if(!$response->ok()){
            return redirect()->back()->with('error', 'Terjadi kesalahan pada server');
        }

        return redirect()->back()->with('success', 'Sukses melakukan pendaftaran pengguna');
    }

    public function login(Request $request){
        $response = Http::post(env('RPC_URL'). 'login', [
            'username' => $request->username,
            'password' => $request->password
        ]);

        if($response->ok()){
            $request->session()->put('id', $response->json()['data']['id']);
            $request->session()->put('username', $response->json()['data']['username']);
            $request->session()->put('role', $response->json()['data']['role']);
        } else {
            return redirect()->back()->with('error', 'Username Atau Password Anda Salah');
        }

        return redirect('/');
    }

    public function login_view(Request $request){
        if ($request->session()->exists('username')) {
            return redirect('/');
        }

        return view('login');
    }

    public function register_view(Request $request){
        if ($request->session()->exists('username') && $request->session()->exists('role') != 'admin') {
            return redirect('/');
        }

        $title = 'User | Registrasi User';
        $users = Http::get(env('RPC_URL'). 'get_users')->json()['data'];

        return view('register', compact('title', 'users'));
    }

    public function logout(){
        Session::flush();
        return redirect('/user/login')->with('success', 'Sukses Melakukan Logout');
    }
}
