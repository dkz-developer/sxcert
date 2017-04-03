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

// 找回密码页面
Route::get('/findPassword', function () {
	return view('findPassword');
});

// 下载页
Route::get('/load', function () {
	return view('load');
});

// 下载页 search
Route::get('/search', function () {
	return view('search');
});

// 下载页 详情页
Route::get('/info', function () {
	return view('info');
});

// 个人 详情页
Route::get('/users', function () {
	return view('users');
});

// 意见反馈页面
Route::get('/feedback', function () {
	return view('feedback');
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
	Route::post('/admin/commonAdd', 'InfoController@commonAdd');
	Route::post('/admin/fileUpload','InfoController@fileUpload');
	Route::post('/admin/addInfoHandle','InfoController@addInfoHandle');
});

// 前台
Route::group(['namespace' => 'Custome'], function () {
	Route::get('/custome/login', 'UserController@login');
	Route::post('/custome/loadlist', 'LoadListController@loadlist');
	Route::post('/custome/detail', 'LoadListController@detail');
	Route::get('/custome/forum', 'ForumController@ForumList');
	
});