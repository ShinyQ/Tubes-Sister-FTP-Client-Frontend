<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\StatisticController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [UserController::class, 'index']);

Route::group(['prefix' => 'user'], function() {
    Route::get('/login', [UserController::class, 'login_view']);
    Route::post('/login',[UserController::class, 'login']);
    Route::get('/logout',[UserController::class, 'logout']);
    Route::get('/statistic', [StatisticController::class, 'statistic']);
    Route::get('/log', [StatisticController::class, 'log']);
});

Route::group(['prefix' => 'file'], function() {
    Route::get('/', [FileController::class, 'index']);
    Route::post('/upload', [FileController::class, 'upload']);
    Route::get('/download/{id}', [FileController::class, 'download']);
});