<?php

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
// 首页
Route::get('/', function () {
	return view('index');
});
 
// 登录注册页
Route::get('/login', function () {
	return view('login');
});

// 后台路由
Route::group(['namespace' => 'Admin'], function () {
	// 后台登录
	Route::get('/admin/login', 'UserController@login');
	Route::get('/admin/kit/captcha/{tmp}', 'UserController@captcha');
	Route::get('/admin/logout', 'UserController@logout');
	Route::get('/admin/index', 'UserController@index');
	Route::post('/admin/loginHandle', 'UserController@loginHandle');
	Route::get('/admin/addInfo', 'InfoController@addInfo');
	Route::get('/admin/infoList', 'InfoController@infoList');
	Route::get('/admin/common', 'InfoController@common');
	Route::get('/admin/commonPage', 'InfoController@commonPage');
});

//注册接口

