<?php

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

Route::get('/onLogin','Wx@onLogin');

Route::get('/get_info','Wx@index');
//数据添加
Route::post('/installData','wx@installData');
//获取订单数据
Route::post('/getInstallData','wx@getInstallData');
//获取数据详情页面
Route::post('/getInstallInfo','wx@getInstallInfo');

Route::post('auth/code', 'AuthController@code');

Route::middleware('wechat')->group(function() {
    Route::post('auth', 'AuthController@index');
});
