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

        $title = 'User | Homepage';
        return view('index', compact('title'));
    }

    public function register(Request $request){
        $response = Http::post( env('RPC_URL'). 'register', [
            'username' => $request->username,
            'password' => $request->password
        ]);

        return $response->ok();
    }

    public function login(Request $request){
        $response = Http::post(env('RPC_URL'). 'login', [
            'username' => $request->username,
            'password' => $request->password
        ]);

        if($response->ok()){
            $request->session()->put('id', $response->json()['data']['id']);
            $request->session()->put('username', $response->json()['data']['username']);
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

    public function logout(){
        Session::flush();
        return redirect('/user/login')->with('success', 'Sukses Melakukan Logout');
    }
}
